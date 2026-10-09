# 📚 CarryOn — Instructor Study Guide PART 2
# Models, Relationships & Database Structure

> **This is Part 2.** Part 1 covers Controllers & Routes → `INSTRUCTOR_STUDY_GUIDE.md`
>
> This guide explains **how the data is structured** behind the scenes —
> the Models, their relationships to each other, and the database tables they use.
> Think of this as understanding the "skeleton" of the whole system.

---

## 🗂️ What is a Model?

In Laravel, a **Model** is a PHP class that represents **one table in the database**.
Every row in the table = one object in PHP.

```
Database Table   →  Laravel Model         →  Used in Controller
────────────────────────────────────────────────────────────────
class_rooms      →  ClassRoom.php         →  InstructorDashboardController
groups           →  Group.php             →  InstructorGroupController
projects         →  Project.php           →  InstructorProjectController
tasks            →  Task.php              →  InstructorTaskLedgerController
users            →  User.php              →  (Auth, Student, Instructor records)
task_assignments →  TaskAssignment.php    →  Task Ledger rows
task_submissions →  TaskSubmission.php    →  Task Ledger rows
```

---

## 🔗 How All Models Connect (Big Picture)

```
User (Instructor)
  └── has many ──→ ClassRoom
                      ├── belongs to many → User (Students)   [pivot: class_student]
                      ├── has many ───────→ Group
                      │                      ├── belongs to many → User (Students)  [pivot: group_members]
                      │                      └── belongs to many → Project           [pivot: project_groups]
                      └── (through groups) → Project
                                               └── has many → Task
                                                                ├── has many → TaskAssignment
                                                                │                └── belongs to → User (Student)
                                                                └── has many → TaskSubmission
                                                                                 └── belongs to → User (Student)
```

> **How to read this:**
> - `has many` = "one of me owns many of them" (1 class has many groups)
> - `belongs to` = "I am owned by one of them" (a group belongs to 1 class)
> - `belongs to many` = "we share each other through a middle table" (students ↔ classes)

---

## ✅ BASICS — The Core Models

---

### 1. User Model

**File:** `app/Models/User.php`
**Database Table:** `users`

**What it stores:**
One row = one person in the system (admin, instructor, or student).

**The columns (`$fillable`):**

```php
protected $fillable = [
    'name',        // Full name of the person
    'email',       // Login email
    'password',    // Hashed password (never stored as plain text)
    'role',        // "Admin", "Instructor", or "Student"
    'department',  // What department they belong to
    'status',      // Active/inactive account
    'student_id',  // School ID number (only for students, e.g., "2021-001")
];
```

> **Key concept:** The `role` column determines who sees what.
> The middleware `role:Instructor` checks this column to block non-instructors from instructor pages.

**Hidden fields:**

```php
protected $hidden = [
    'password'  // This field will NEVER appear in JSON responses — always hidden for security
];
```

**Relationships:**

```php
// Line 26–31: An instructor USER has many ClassRooms they teach
// "Give me all classes where I am the instructor"
public function instructorClasses(): HasMany {
    return $this->hasMany(ClassRoom::class, 'Instructor_Id');
}

// Line 34–42: A student USER belongs to many ClassRooms (enrolled in)
// Uses pivot table: class_student (class_room_id, student_id)
public function classes(): BelongsToMany {
    return $this->belongsToMany(
        ClassRoom::class,
        'class_student',   // The name of the middle/pivot table
        'student_id',      // Column in pivot that points to this user
        'class_room_id'    // Column in pivot that points to the classroom
    )->withTimestamps();
}

// Line 44–54: A student USER belongs to many Groups
// Uses pivot table: group_members, with extra column 'is_leader'
public function groups(): BelongsToMany {
    return $this->belongsToMany(
        Group::class,
        'group_members',
        'student_id',
        'group_id'
    )
    ->withPivot('is_leader')  // Also load the is_leader column from the pivot table
    ->withTimestamps();
}
```

---

### 2. ClassRoom Model

**File:** `app/Models/ClassRoom.php`
**Database Table:** `class_rooms`

**What it stores:**
One row = one subject/course offered in a specific semester.

**The columns (`$fillable`):**

```php
protected $fillable = [
    'course_code',    // e.g., "CS101"
    'course_name',    // e.g., "Introduction to Programming"
    'offer_code',     // Unique offering code (e.g., "CS101-A")
    'semester',       // "1st Semester", "2nd Semester", or "Summer"
    'academic_year',  // e.g., "2024-25"
    'Instructor_Id',  // Foreign key → which instructor owns this class
    'is_archived',    // true/false (manual archive flag)
];
```

**Special column behavior:**

```php
protected $casts = [
    'is_archived' => 'boolean',
    // When you read is_archived from the DB (0 or 1),
    // Laravel automatically converts it to true or false
];
```

**Relationships:**

```php
// Line 247–248: Which instructor teaches this class?
public function instructor(): BelongsTo {
    return $this->belongsTo(User::class, 'Instructor_Id', 'id');
    //                               ↑ foreign key     ↑ local key on users table
}

// Line 251–257: Which students are enrolled in this class?
// Uses pivot table: class_student
public function students(): BelongsToMany {
    return $this->belongsToMany(
        User::class,
        'class_student',    // Middle/pivot table name
        'class_room_id',    // Column in pivot → points to classroom
        'student_id'        // Column in pivot → points to user
    )->withTimestamps();
}

// Line 260–264: Which groups belong to this class?
public function groups(): HasMany {
    return $this->hasMany(Group::class, 'class_room_id');
}
```

---

## 🟡 INTERMEDIATE — Scopes & Smart Logic in ClassRoom

---

### 3. How "Active" vs "Archived" Works (ClassRoom Scopes)

There is NO manual archive button. Classes are automatically active or archived **based on the calendar**.

**The semester calendar logic:**

| Month | Semester |
|---|---|
| August – December | 1st Semester |
| January – May | 2nd Semester |
| June – July | Summer |

If a class belongs to a **past semester or past school year**, it's automatically archived.

---

#### `getCurrentAcademicYear()` — Line 31

```php
// Line 33: First check if the academic year is set in the config/env file
$configured = config('app.current_academic_year');
if ($configured) { return $configured; }

// Line 39–46: If NOT configured, calculate it from today's date
$year  = (int) date('Y');   // e.g., 2025
$month = (int) date('n');   // e.g., 9 (September)

if ($month >= 6) {
    // June or later = new academic year started
    // Result: "2025-26"
    return $year . '-' . substr((string)($year + 1), -2);
} else {
    // Before June = still in the previous academic year
    // Result: "2024-25"
    return ($year - 1) . '-' . substr((string)$year, -2);
}
```

> **Example:** Today = September 2025 → month=9 → 9 >= 6 → returns `"2025-26"`

---

#### `getCurrentSemester()` — Line 56

```php
$month = (int) date('n');

if ($month >= 8 && $month <= 12) {
    return '1st Semester';   // Aug, Sep, Oct, Nov, Dec
} elseif ($month >= 1 && $month <= 5) {
    return '2nd Semester';   // Jan, Feb, Mar, Apr, May
} else {
    return 'Summer';         // Jun, Jul
}
```

---

#### `getSemesterRank()` — Line 77

```php
// Converts semester names into numbers so we can compare them
// "1st Semester" → 1
// "2nd Semester" → 2
// "Summer"       → 3

// This lets us ask: "Has semester X already passed?" by comparing numbers.
// e.g., If current rank = 2 (2nd Semester), then rank 1 (1st Semester) has already ended.
```

---

#### `scopeActive()` — Line 160 ⭐ Complex

**What it does:** Filters the database query to return ONLY active classes.
Called in controllers like: `ClassRoom::...->active($year, $semester)->get()`

**Logic in plain English:**
> "Give me classes where the school year is in the future,
> OR the school year matches AND the semester hasn't ended yet."

```php
return $query->where(function ($q) use ($currentStart, $currentRank) {

    // Rule 1 (Line 170): Classes from FUTURE school years are always active
    $q->whereRaw("SUBSTR(academic_year, 1, 4) > ?", [$currentStart])

    // Rule 2 (Line 172): OR classes from the SAME school year
    ->orWhere(function ($sameYearQ) use ($currentStart, $currentRank) {
        $sameYearQ->whereRaw("SUBSTR(academic_year, 1, 4) = ?", [$currentStart]);

        // If we're in 2nd semester: 1st semester classes are no longer active
        if ($currentRank === 2) {
            $sameYearQ->where(function ($semQ) {
                $semQ->where('semester', '!=', '1st Semester')...
            });
        }

        // If we're in Summer: only Summer classes are still active
        elseif ($currentRank === 3) {
            $sameYearQ->where(function ($semQ) {
                $semQ->where('semester', 'Summer')...
            });
        }
        // If we're in 1st semester (rank=1): all same-year classes are active
    });
});
```

---

#### `scopeArchived()` — Line 200 ⭐ Complex

The **opposite of scopeActive.** Returns ONLY classes from past periods.

```php
// Logic: classes where the school year has ALREADY PASSED
// OR the school year is the same but the semester rank is lower (= that semester ended)

// Example:
// Current: 2025-26, 2nd Semester (rank 2)
// Archived = same-year classes with rank < 2  → 1st Semester classes are now archived
// Also archived = any class from 2024-25 or earlier (past years)
```

---

### 4. Group Model

**File:** `app/Models/Group.php`
**Database Table:** `groups`

**What it stores:**
One row = one student group inside a class.

**Columns:**
```php
protected $fillable = [
    'class_room_id',  // Which class this group belongs to
    'name',           // Group name (e.g., "Group 1" or a custom name)
    'group_number',   // Numeric order (1, 2, 3...)
];
```

**Relationships:**

```php
// "This group belongs to one ClassRoom"
public function classRoom(): BelongsTo { ... }

// "This group has many students" (via pivot: group_members)
// Also loads 'is_leader' extra column from pivot
public function students(): BelongsToMany {
    return $this->belongsToMany(User::class, 'group_members', 'group_id', 'student_id')
        ->withPivot('is_leader')   // ← extra column from the pivot table
        ->withTimestamps();
}

// "This group is assigned to many projects" (via pivot: project_groups)
public function projects(): BelongsToMany {
    return $this->belongsToMany(Project::class, 'project_groups', 'group_id', 'project_id')
        ->withTimestamps();
}
```

---

### 5. Project Model

**File:** `app/Models/Project.php`
**Database Table:** `projects`

**What it stores:**
One row = one project assigned to student groups.

**Columns:**
```php
protected $fillable = [
    'class_room_id',  // Which class this project belongs to
    'title',          // Project name
    'description',    // Optional longer description
    'start_date',     // When the project starts
    'end_date',       // When the project ends (must be >= start_date)
    'status',         // e.g., "Active", "Completed", "On Hold"
];

protected $casts = [
    'start_date' => 'date',  // Auto-converts to Carbon date object for easy date math
    'end_date'   => 'date',
];
```

**Relationships:**

```php
// "This project belongs to one ClassRoom"
public function classRoom(): BelongsTo { ... }

// "This project is assigned to many Groups" (via pivot: project_groups)
public function groups(): BelongsToMany {
    return $this->belongsToMany(Group::class, 'project_groups', 'project_id', 'group_id')
        ->withTimestamps();
}

// "This project has many Tasks"
public function tasks(): HasMany {
    return $this->hasMany(Task::class, 'project_id');
}
```

---

## 🔴 ADVANCED — The Task Chain

---

### 6. Task Model

**File:** `app/Models/Task.php`
**Database Table:** `tasks`

**What it stores:**
One row = one specific task/deliverable inside a project.

**Columns:**
```php
protected $fillable = [
    'project_id',   // Which project this task belongs to
    'group_id',     // Which group is responsible for this task
    'title',        // Task name (e.g., "Submit Requirements Document")
    'description',  // What the task requires
    'points',       // How many points the task is worth
    'due_date',     // Deadline for the task
    'file_path',    // Optional file the instructor attached
    'status',       // Current status (e.g., "Pending", "Done")
];
```

**Relationships:**

```php
// "This task belongs to one Project"
public function project(): BelongsTo { ... }

// "This task belongs to one Group (the responsible group)"
public function group(): BelongsTo { ... }

// "This task has many Assignments (one record per assigned student)"
// One task can be assigned to MULTIPLE individual students
public function assignments(): HasMany {
    return $this->hasMany(TaskAssignment::class, 'task_id');
}

// "This task has many Submissions (one record per student who submitted)"
// Each student submits separately, and can submit multiple times
public function submissions(): HasMany {
    return $this->hasMany(TaskSubmission::class, 'task_id');
}
```

> **Key concept:** A Task is assigned to a GROUP, but individual students each get their
> own `TaskAssignment` and `TaskSubmission` record. This is why the Task Ledger
> shows MULTIPLE rows per task (one per student).

---

### 7. TaskAssignment Model

**File:** `app/Models/TaskAssignment.php`
**Database Table:** `task_assignments`

**What it stores:**
One row = "this specific student is assigned to this specific task."

**Columns:**
```php
protected $fillable = [
    'task_id',       // Which task
    'student_id',    // Which student (foreign key → users table)
    'status',        // e.g., "Assigned", "In Progress", "Completed"
    'started_at',    // When the student started working on it
    'completed_at',  // When the student finished
];

protected $casts = [
    'started_at'   => 'datetime',  // Auto-converts to Carbon datetime object
    'completed_at' => 'datetime',
];
```

**Relationships:**

```php
// "This assignment belongs to one Task"
public function task(): BelongsTo { ... }

// "This assignment belongs to one Student (User)"
public function student(): BelongsTo {
    return $this->belongsTo(User::class, 'student_id');
}
```

---

### 8. TaskSubmission Model

**File:** `app/Models/TaskSubmission.php`
**Database Table:** `task_submissions`

**What it stores:**
One row = "this student submitted something for this task."
A student can submit MULTIPLE times — each attempt is a new row.

**Columns:**
```php
protected $fillable = [
    'task_id',         // Which task was submitted
    'student_id',      // Which student submitted it
    'submission_text', // What the student wrote (text submission)
    'file_path',       // Or a file they uploaded
    'status',          // "Pending", "Approved", "Rejected"
    'submitted_at',    // When they submitted
    'approved_at',     // When the instructor approved it
    'approved_by',     // Which instructor/user approved it (foreign key → users)
    'feedback',        // Instructor's feedback/comments
];

protected $casts = [
    'submitted_at' => 'datetime',
    'approved_at'  => 'datetime',
];
```

**Relationships:**

```php
// "This submission belongs to one Task"
public function task(): BelongsTo { ... }

// "This submission was made by one Student"
public function student(): BelongsTo {
    return $this->belongsTo(User::class, 'student_id');
}

// "This submission was approved by one User (the instructor)"
public function approver(): BelongsTo {
    return $this->belongsTo(User::class, 'approved_by');
}
```

> **Key insight:** In the Task Ledger, the controller grabs the **most recent** submission
> per student using `sortByDesc()`. This is because a student may resubmit after feedback,
> and we only care about the latest attempt.

---

## 📊 Database Tables Summary

| Table Name | Model | What Each Row Represents |
|---|---|---|
| `users` | `User` | One person (Admin, Instructor, or Student) |
| `class_rooms` | `ClassRoom` | One course offering (e.g., CS101 - 1st Sem 2024) |
| `class_student` | *(pivot — no model)* | Links: which student is in which class |
| `groups` | `Group` | One student group inside a class |
| `group_members` | `GroupMember` | Links: which student is in which group + is_leader |
| `projects` | `Project` | One project assigned to groups |
| `project_groups` | *(pivot — no model)* | Links: which groups are working on which project |
| `tasks` | `Task` | One task/deliverable inside a project |
| `task_assignments` | `TaskAssignment` | Which student is assigned to which task |
| `task_submissions` | `TaskSubmission` | One submission attempt by a student for a task |

---

## 🔗 Pivot Tables Explained

A **pivot table** is a "bridge" table that connects two other tables in a many-to-many relationship.

### `class_student` — Students enrolled in classes

```
users table          class_student (pivot)          class_rooms table
───────────          ──────────────────────          ─────────────────
id = 5    ←──── student_id | class_room_id ────→    id = 12
(Juan)              5       |     12                (CS101)
                    7       |     12                (CS101)
                    5       |     15                (CS102)
```
> Juan (id=5) is enrolled in both CS101 and CS102.

---

### `group_members` — Students inside groups (with leader flag)

```
group_members (pivot)
──────────────────────────────────
group_id | student_id | is_leader
   3     |     5      |   false
   3     |     7      |   true    ← Student 7 is the leader of group 3
   4     |     9      |   false
```

---

### `project_groups` — Which groups are assigned to which project

```
project_groups (pivot)
──────────────────────────
project_id | group_id
    1      |    3      ← Project 1 ("Final App") is assigned to Group 3 AND Group 4
    1      |    4
    2      |    5
```

---

## 🧠 Relationship Types — Quick Reference

| Type | Code | Meaning | Example |
|---|---|---|---|
| `hasMany` | `$this->hasMany(X, 'fk')` | I own many X's | ClassRoom has many Groups |
| `belongsTo` | `$this->belongsTo(X, 'fk')` | X owns me | Group belongs to ClassRoom |
| `belongsToMany` | `$this->belongsToMany(X, 'pivot', 'my_fk', 'their_fk')` | We share each other via pivot | Students ↔ Classes |
| `withPivot('col')` | chained on BelongsToMany | Load extra column from pivot | `is_leader` from group_members |
| `withTimestamps()` | chained on BelongsToMany | Pivot table has created_at/updated_at | All pivot tables here |

---

## 🧠 Concepts to Master (by difficulty)

| Concept | Found In | Difficulty |
|---|---|---|
| `$fillable` — which columns can be mass-assigned | All models | ⭐ Easy |
| `$casts` — auto-convert column types | ClassRoom, Project, Task | ⭐ Easy |
| `$hidden` — hide fields from JSON output | User | ⭐ Easy |
| `hasMany()` relationship | ClassRoom → Groups, Task → Submissions | ⭐⭐ Easy |
| `belongsTo()` relationship | Group → ClassRoom, Task → Project | ⭐⭐ Easy |
| `belongsToMany()` with pivot table | Students ↔ Classes, Groups ↔ Projects | ⭐⭐⭐ Medium |
| `->withPivot()` — loading extra pivot columns | Group → Students (is_leader) | ⭐⭐⭐ Medium |
| `getCurrentAcademicYear()` calendar logic | ClassRoom | ⭐⭐⭐ Medium |
| `getCurrentSemester()` month-based logic | ClassRoom | ⭐⭐⭐ Medium |
| `getSemesterRank()` — comparing semesters numerically | ClassRoom | ⭐⭐⭐ Medium |
| `scopeActive()` — complex WHERE query builder | ClassRoom | ⭐⭐⭐⭐ Hard |
| `scopeArchived()` — inverse of scopeActive | ClassRoom | ⭐⭐⭐⭐ Hard |
| Why Task Ledger has multiple rows per task | TaskAssignment logic | ⭐⭐⭐⭐ Hard |
| Multiple submissions per student, pick latest | TaskSubmission + sortByDesc | ⭐⭐⭐⭐⭐ Hard |

---

## 🗂️ File Reference — Models

| File | Table | Purpose |
|---|---|---|
| `app/Models/User.php` | `users` | All users — admins, instructors, students |
| `app/Models/ClassRoom.php` | `class_rooms` | Course offerings + archive/active logic |
| `app/Models/Group.php` | `groups` | Student groups inside a class |
| `app/Models/Project.php` | `projects` | Projects assigned to groups |
| `app/Models/Task.php` | `tasks` | Tasks/deliverables inside a project |
| `app/Models/TaskAssignment.php` | `task_assignments` | Which student is assigned to which task |
| `app/Models/TaskSubmission.php` | `task_submissions` | Student submissions + instructor feedback |

---

> 📖 **Part 1 — Controllers & Routes:** `INSTRUCTOR_STUDY_GUIDE.md`
