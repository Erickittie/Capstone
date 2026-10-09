# 📚 CarryOn — Instructor Side Study Guide

> This guide walks through every feature an instructor can use in the CarryOn system.
> Features are organized from **Basic → Hard** so you can study them in order.
> Each section explains **what it does**, **where the code lives**, and **where it goes** (the URL/route).

---

## 🗺️ Quick Map — How Pages Connect

```
Login
  └── Instructor Dashboard  (/instructor/dashboard)
        ├── [Card Click] → Course Detail  (/instructor/class/{id})
        │       ├── [Tab] → Groups        (/instructor/class/{id}/groups)
        │       ├── [Tab] → Projects      (/instructor/class/{id}/projects)
        │       └── [Tab] → Task Ledger   (/instructor/class/{id}/task-ledger)
        └── [Link] → Archive             (/instructor/archive)
```

---

## ✅ BASICS — Start Here

---

### 1. Instructor Dashboard

**What it does:**
This is the first page the instructor sees after logging in.
It shows all the **active classes** that belong to the logged-in instructor.
It also shows how many **archived classes** they have.

**Where is the code?**
- Controller: [`InstructorDashboardController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorDashboardController.php) → `index()` method (Line 11)
- View: [`resources/views/instructor/dashboard.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/dashboard.blade.php)

**Where does it go (URL/Route)?**
- URL: `/instructor/dashboard`
- Route name: `instructor.dashboard`

**Line-by-line breakdown (Controller):**

```php
// Line 13: Gets the current academic year (e.g., "2024-2025")
$currentAcademicYear = ClassRoom::getCurrentAcademicYear();

// Line 14: Gets the current semester (e.g., "1st Semester")
$currentSemester = ClassRoom::getCurrentSemester();

// Lines 16–19: Fetches only the classes that belong to this instructor
// AND are active (not archived) in the current school year/semester
$classes = ClassRoom::where('Instructor_Id', Auth::id())
    ->active($currentAcademicYear, $currentSemester)
    ->latest()  // newest classes show first
    ->get();

// Lines 21–23: Just counts how many classes are archived, for the badge on the dashboard
$archivedCount = ClassRoom::where('Instructor_Id', Auth::id())
    ->archived($currentAcademicYear, $currentSemester)
    ->count();

// Line 25: Sends all the data to the dashboard view (the HTML page)
return view('instructor.dashboard', compact('classes', 'archivedCount', ...));
```

---

### 2. View Class / Course Detail

**What it does:**
When an instructor clicks on a class card from the dashboard, they are taken to the **Course Detail** page.
This page shows all the students enrolled in that class, and gives access to Groups, Projects, and Task Ledger tabs.

**Where is the code?**
- Controller: [`InstructorClassController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorClassController.php) → `show()` method (Line 13)
- View: [`resources/views/instructor/course-detail.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/course-detail.blade.php)

**Where does it go?**
- URL: `/instructor/class/{classId}`
- Route name: `instructor.class.configure`

**Line-by-line breakdown:**

```php
// Line 14: Find the classroom by its ID
$class = ClassRoom::where('id', $classId)
    // Line 15: But ONLY if this instructor owns that class (security check!)
    ->where('Instructor_Id', Auth::id())
    // Line 16: Also load the list of students who are in this class
    ->with('students')
    // Line 17: If not found, show a 404 error page automatically
    ->firstOrFail();

// Line 19: Send the class data to the course-detail view
return view('instructor.course-detail', compact('class'));
```

> **Key concept:** `->where('Instructor_Id', Auth::id())` is a **security check**.
> It makes sure an instructor can ONLY see their OWN classes, not other instructors'.

---

### 3. Archive Page

**What it does:**
Shows all **old/past** classes that are no longer active.
The instructor can **search by course name** or **filter by academic year**.

**Where is the code?**
- Controller: [`InstructorDashboardController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorDashboardController.php) → `archive()` method (Line 28)
- View: [`resources/views/instructor/archive.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/archive.blade.php)

**Where does it go?**
- URL: `/instructor/archive`
- Route name: `instructor.archive`

**Line-by-line breakdown:**

```php
// Lines 33–34: Start a query for archived classes owned by this instructor
$query = ClassRoom::where('Instructor_Id', Auth::id())
    ->archived($currentAcademicYear, $currentSemester);

// Lines 36–38: Optional filter — if the instructor picks a specific school year,
// only show that year's classes
$selectedYear = $request->query('academic_year');
if ($selectedYear && $selectedYear !== 'all') {
    $query->where('academic_year', $selectedYear);
}

// Lines 41–47: Optional search — if the instructor types in the search box,
// filter by course name, course code, or offer code
$search = $request->query('search');
if ($search) {
    $query->where(function ($q) use ($search) {
        $q->where('course_name', 'like', "%{$search}%")
          ->orWhere('course_code', 'like', "%{$search}%")
          ->orWhere('offer_code', 'like', "%{$search}%");
    });
}
```

---

## 🟡 INTERMEDIATE — Once You Understand Basics

---

### 4. Import Roster (Upload Student List via CSV)

**What it does:**
Instead of adding students one by one, the instructor can **upload a CSV file** (spreadsheet) containing all student names, emails, and IDs.
The system reads the file and automatically enrolls all valid students into the class.

**Where is the code?**
- Controller: [`InstructorClassController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorClassController.php) → `importRoster()` method (Line 22)
- View: Inside [`course-detail.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/course-detail.blade.php) (the upload form)

**Where does it go?**
- URL: `POST /instructor/class/{classId}/roster/import`
- Route name: `instructor.class.roster.import`

**Line-by-line breakdown:**

```php
// Line 28–30: Validates the uploaded file. It must be a CSV/TXT file, max 2MB.
$request->validate([
    'roster' => 'required|file|mimes:csv,txt|max:2048'
]);

// Line 34: Opens the uploaded file so we can read it line by line
$handle = fopen($file->getRealPath(), 'r');

// Line 43: Reads the FIRST ROW of the CSV (the header row with column names)
$header = fgetcsv($handle);

// Lines 54–58: Cleans up the column names:
// - trim() removes extra spaces
// - str_replace removes BOM character (invisible character Excel sometimes adds)
$header = array_map(function ($value) {
    return trim(str_replace("\xEF\xBB\xBF", '', $value));
}, $header);

// Lines 60–76: Checks that the CSV has all 3 required columns: student_id, name, email.
// If any are missing, it stops and shows an error message.
$requiredColumns = ['student_id', 'name', 'email'];

// Lines 81–131: Reads each row in the CSV one by one:
while (($row = fgetcsv($handle)) !== false) {

    // Line 82: Skip blank rows
    if (count(array_filter($row)) === 0) { continue; }

    // Lines 91: Combine header + row into an associative array
    // e.g., ['student_id' => '2021-001', 'name' => 'Juan', 'email' => 'juan@email.com']
    $data = array_combine($header, $row);

    // Lines 111–119: Look up the student in the users table by their student_id
    // AND make sure their role is 'Student' (not admin or instructor)
    $student = User::where('student_id', $studentId)
        ->where('role', 'Student')
        ->first();

    // Line 121–124: If the student doesn't exist in the system, skip them (count as skipped)
    if (!$student) { $skipped++; continue; }

    // Lines 126–128: Add the student to the class (without removing existing students)
    $class->students()->syncWithoutDetaching([$student->id]);
    $imported++;
}

// Line 135–139: After processing all rows, show a success message:
// "X student(s) imported successfully. Y row(s) skipped."
```

> **Key concept:** `syncWithoutDetaching()` means "add these students without removing the ones already there." Think of it like adding to a list without erasing what's already written.

---

### 5. View Groups Page

**What it does:**
Shows all the student groups for a specific class.
Displays which students are in which group, and allows the instructor to manage groupings.

**Where is the code?**
- Controller: [`InstructorGroupController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorGroupController.php) → `index()` method (Line 14)
- View: [`resources/views/instructor/groups.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/groups.blade.php)

**Where does it go?**
- URL: `/instructor/class/{classId}/groups`
- Route name: `instructor.class.groups`

**Line-by-line breakdown:**

```php
// Lines 15–21: Fetch the class (security check included) and eagerly load:
// - 'students': all students in the class
// - 'groups.students': all groups AND the students inside each group
$class = ClassRoom::where('id', $classId)
    ->where('Instructor_Id', Auth::id())
    ->with(['students', 'groups.students'])
    ->firstOrFail();
```

> **Key concept:** `->with(['students', 'groups.students'])` is called **eager loading**.
> It loads all related data in one go to avoid slow, repeated database calls.

---

### 6. View Projects Page

**What it does:**
Lists all projects created for a specific class.
Projects are assigned to student groups. The instructor can see all projects and which groups are working on them.

**Where is the code?**
- Controller: [`InstructorProjectController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorProjectController.php) → `index()` method (Line 12)
- View: [`resources/views/instructor/projects/index.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/projects/index.blade.php)

**Where does it go?**
- URL: `/instructor/class/{classId}/projects`
- Route name: `instructor.projects.index`

---

## 🔴 ADVANCED / HARD — The Complex Features

---

### 7. Manual Group Assignment

**What it does:**
The instructor manually builds the groups by dragging students into group slots.
When they click save, the system **deletes all old groups** and **rebuilds them from scratch** using the submitted data.

**Where is the code?**
- Controller: [`InstructorGroupController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorGroupController.php) → `saveManual()` method (Line 29)
- View: [`resources/views/instructor/groups.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/groups.blade.php)

**Where does it go?**
- URL: `POST /instructor/class/{classId}/groups/manual`
- Route name: `instructor.class.groups.manual`

**Line-by-line breakdown:**

```php
// Lines 34–39: Validates the submitted group data:
// - Must have at least 1 group
// - Each group must have a name (max 255 characters)
// - Students in each group must be valid IDs that exist in the users table
$request->validate([
    'groups' => 'required|array|min:1',
    'groups.*.name' => 'required|string|max:255',
    'groups.*.students' => 'nullable|array',
]);

// Lines 41–74: DB::transaction wraps everything in a "safety bubble".
// If ANY step fails, NOTHING gets saved (all-or-nothing).
DB::transaction(function () use ($request, $class) {

    // Line 42: DELETE all existing groups for this class first (clean slate)
    $class->groups()->delete();

    // Lines 44–73: Loop through each group submitted by the instructor
    foreach ($request->groups as $index => $groupData) {

        // Lines 46–49: Create the group in the database
        $group = $class->groups()->create([
            'name' => $groupData['name'],
            'group_number' => $index + 1,  // Group 1, Group 2, etc.
        ]);

        // Lines 51–71: If the group has students, attach them to the group
        if (!empty($groupData['students'])) {
            // Build an array where each student gets ['is_leader' => false]
            foreach ($groupData['students'] as $studentId) {
                $students[] = ['students_id' => $studentId, 'is_leader' => false];
            }
            $group->students()->attach(...); // Link students to the group
        }
    }
});
```

> **Key concept:** `DB::transaction()` is a safety wrapper. If adding a student fails halfway through, it will **undo everything** done before that point — like Ctrl+Z for the database.

---

### 8. Automatic Group Assignment

**What it does:**
Instead of manually placing students, the instructor just picks **how many groups** they want.
The system **randomly shuffles** all students and distributes them evenly across the groups automatically.

**Where is the code?**
- Controller: [`InstructorGroupController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorGroupController.php) → `automatic()` method (Line 82)
- View: [`resources/views/instructor/groups.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/groups.blade.php)

**Where does it go?**
- URL: `POST /instructor/class/{classId}/groups/automatic`
- Route name: `instructor.class.groups.automatic`

**Line-by-line breakdown:**

```php
// Lines 89–96: Validates input. 
// number_of_groups must be at least 1, and can't exceed total number of students
$request->validate([
    'number_of_groups' => [
        'required', 'integer', 'min:1',
        'max:' . max(1, $class->students->count()),
    ],
]);

// Lines 98–100: Gets all students and SHUFFLES them randomly
$students = $class->students->shuffle()->values();

$numberOfGroups = (int) $request->number_of_groups;

// Line 104: Safety transaction again
DB::transaction(function () use ($class, $students, $numberOfGroups) {

    // Line 110: Delete old groups
    $class->groups()->delete();

    // Lines 114–119: Create N empty groups (Group 1, Group 2, ...)
    for ($i = 1; $i <= $numberOfGroups; $i++) {
        $groups[] = $class->groups()->create([
            'name' => 'Group ' . $i,
            'group_number' => $i,
        ]);
    }

    // Lines 121–130: Distribute students using the MODULO trick:
    // Student 0 → Group 0, Student 1 → Group 1, Student 2 → Group 2,
    // Student 3 → Group 0 (wraps around), and so on...
    foreach ($students as $index => $student) {
        $groupIndex = $index % $numberOfGroups;  // % = remainder = round-robin distribution
        $groups[$groupIndex]->students()->attach($student->id, ['is_leader' => false]);
    }
});
```

> **Key concept:** The `%` (modulo) operator is the secret to even distribution.
> If you have 10 students and 3 groups: 0%3=0, 1%3=1, 2%3=2, 3%3=0, 4%3=1...
> Students automatically "wrap around" to fill groups evenly.

---

### 9. Create a Project

**What it does:**
The instructor creates a new project, gives it a title, description, dates, and assigns it to one or more student groups.

**Where is the code?**
- Controller: [`InstructorProjectController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorProjectController.php) → `store()` method (Line 49)
- View (form): [`resources/views/instructor/projects/create.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/projects/create.blade.php)

**Where does it go?**
- URL: `POST /instructor/class/{classId}/projects`
- Route name: `instructor.projects.store`
- After saving, redirects to → `instructor.projects.index`

**Line-by-line breakdown:**

```php
// Lines 55–90: Validates all the form inputs:
// - title: required, max 255 characters
// - description: optional
// - start_date: optional, must be a valid date
// - end_date: optional, must be AFTER or equal to start_date
// - status: required (e.g., "Active", "Completed")
// - groups: required, must be an array of at least 1 group
// - groups.*: each group ID must exist in the 'groups' table
$request->validate([...]);

// Lines 92–95: Security check for groups.
// Re-fetches which group IDs actually belong to this class
// (prevents someone submitting a group ID from another class!)
$validGroupIds = $class->groups()
    ->whereIn('groups.id', $request->groups)
    ->pluck('groups.id')
    ->toArray();

// Lines 98–106: If the number of valid groups doesn't match what was submitted,
// reject the request — someone may be tampering with the form
if (count($validGroupIds) !== count($request->groups)) {
    return back()->withInput()->withErrors([...]);
}

// Lines 108–115: Create the project record in the database
$project = Project::create([
    'class_room_id' => $class->id,
    'title' => $request->title,
    ...
]);

// Line 117: Sync (link) the project to the selected groups using a pivot table
$project->groups()->sync($validGroupIds);
```

> **Key concept:** `->sync()` is smarter than `->attach()`.
> `sync()` will **add new links AND remove old ones** so the relationship always matches exactly what was submitted.

---

### 10. Edit & Update a Project

**What it does:**
Opens an existing project in an edit form, lets the instructor change any field, then saves the changes.

**Where is the code?**
- Controller: [`InstructorProjectController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorProjectController.php)
  - `edit()` method (Line 130) — loads the form
  - `update()` method (Line 152) — saves the changes
- Views: [`resources/views/instructor/projects/edit.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/projects/edit.blade.php)

**Where does it go?**
- Show form: `GET /instructor/class/{classId}/projects/{projectId}/edit` → `instructor.projects.edit`
- Save changes: `PUT /instructor/class/{classId}/projects/{projectId}` → `instructor.projects.update`

**What's the same as Create:**
The validation rules are **identical** to the create step. The key difference:

```php
// Instead of Project::create(...), we UPDATE the existing one:
$project->update([
    'title' => $request->title,
    'description' => $request->description,
    ...
]);

// Then re-sync the groups (removes old, adds new)
$project->groups()->sync($validGroupIds);
```

---

### 11. Delete a Project

**What it does:**
Permanently deletes a project from the class.

**Where is the code?**
- Controller: [`InstructorProjectController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorProjectController.php) → `destroy()` method (Line 239)

**Where does it go?**
- URL: `DELETE /instructor/class/{classId}/projects/{projectId}`
- Route name: `instructor.projects.destroy`
- After deleting → redirects back to `instructor.projects.index`

```php
// Lines 245–248: Finds the project, making sure it belongs to THIS class
$project = Project::where('id', $projectId)
    ->where('class_room_id', $class->id)
    ->firstOrFail();

// Line 249: Permanently deletes it from the database
$project->delete();
```

---

### 12. Task Ledger (Hardest Feature) 🔴

**What it does:**
This is the most complex feature. It's a **read-only report/table** that shows the instructor:
- Every task in every project in this class
- Which student is assigned to each task
- Whether that student submitted the task
- The submission status (approved, pending, not submitted)
- Submission date, approval date, and feedback

Think of it as a **grade book / progress tracker** for all tasks across all projects.

**Where is the code?**
- Controller: [`InstructorTaskLedgerController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorTaskLedgerController.php)
  - `index()` method (Line 12) — renders the full page
  - `data()` method (Line 91) — returns JSON (for live/auto-refresh updates)
- View: [`resources/views/instructor/tasks/ledger.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/tasks/ledger.blade.php)

**Where does it go?**
- Full page: `GET /instructor/class/{classId}/task-ledger` → `instructor.tasks.ledger`
- JSON data (API-like): `GET /instructor/class/{classId}/task-ledger/data` → `instructor.tasks.ledger.data`

**Line-by-line breakdown:**

```php
// Lines 19–29: Fetch all tasks that belong to projects in this class.
// Also load all related data in one query (eager loading):
// - project: what project does this task belong to?
// - group: which group is assigned this task?
// - assignments.student: who is assigned to this task?
// - submissions.student: who submitted something for this task?
$tasks = Task::whereHas('project', function ($query) use ($class) {
        $query->where('class_room_id', $class->id);
    })
    ->with(['project', 'group', 'assignments.student', 'submissions.student'])
    ->latest()
    ->get();

// Lines 33–80: Build the rows array — this is the complex part.
// For EACH task, we loop through EACH assigned student.
// This means one task with 5 students assigned = 5 rows in the table.
$rows = [];

foreach ($tasks as $task) {                        // Loop every task
    foreach ($task->assignments as $assignment) {   // Loop every student assigned to that task

        // Lines 41–47: Find THIS student's submission for THIS task.
        // If they submitted multiple times, take the MOST RECENT one.
        $submission = $task->submissions
            ->where('student_id', $assignment->student_id)
            ->sortByDesc(function ($submission) {
                return $submission->submitted_at ?? $submission->created_at;
            })
            ->first();

        // Lines 49–78: Build one row of data for the table
        $rows[] = [
            'task_title'        => $task->title,
            'project_title'     => $task->project->title ?? 'No Project',
            'group_name'        => $task->group->name ?? 'No Group',
            'student_name'      => $assignment->student->name ?? 'Unknown Student',
            'points'            => $task->points,
            'assignment_status' => $assignment->status,
            // If no submission exists, show "Not Submitted"
            'submission_status' => $submission->status ?? 'Not Submitted',
            'submitted_at'      => $submission?->submitted_at,   // ?-> = null-safe operator
            'approved_at'       => $submission?->approved_at,
            'feedback'          => $submission?->feedback,
        ];
    }
}
```

> **Key concepts to understand here:**
>
> 1. **Nested loops** (`foreach` inside `foreach`) — This is why one task becomes MANY rows.
> 2. **`?->` (null-safe operator)** — If `$submission` is null (student didn't submit), using `$submission?->submitted_at` returns `null` instead of crashing.
> 3. **`sortByDesc()`** — Finds the most recent submission by sorting in reverse date order.
> 4. **Two endpoints** — `index()` returns an HTML page, `data()` returns JSON (used by JavaScript to auto-refresh the table without reloading the page).

---

## 📋 Full Route Reference Table

| Route Name | Method | URL | Controller | What It Does |
|---|---|---|---|---|
| `instructor.dashboard` | GET | `/instructor/dashboard` | `InstructorDashboardController@index` | Shows active classes |
| `instructor.archive` | GET | `/instructor/archive` | `InstructorDashboardController@archive` | Shows old/past classes |
| `instructor.class.configure` | GET | `/instructor/class/{classId}` | `InstructorClassController@show` | Class detail & student list |
| `instructor.class.roster.import` | POST | `/instructor/class/{classId}/roster/import` | `InstructorClassController@importRoster` | Upload CSV to add students |
| `instructor.class.groups` | GET | `/instructor/class/{classId}/groups` | `InstructorGroupController@index` | View all groups |
| `instructor.class.groups.manual` | POST | `/instructor/class/{classId}/groups/manual` | `InstructorGroupController@saveManual` | Save manually built groups |
| `instructor.class.groups.automatic` | POST | `/instructor/class/{classId}/groups/automatic` | `InstructorGroupController@automatic` | Auto-generate groups |
| `instructor.projects.index` | GET | `/instructor/class/{classId}/projects` | `InstructorProjectController@index` | List all projects |
| `instructor.projects.create` | GET | `/instructor/class/{classId}/projects/create` | `InstructorProjectController@create` | Show create project form |
| `instructor.projects.store` | POST | `/instructor/class/{classId}/projects` | `InstructorProjectController@store` | Save new project |
| `instructor.projects.edit` | GET | `/instructor/class/{classId}/projects/{projectId}/edit` | `InstructorProjectController@edit` | Show edit project form |
| `instructor.projects.update` | PUT | `/instructor/class/{classId}/projects/{projectId}` | `InstructorProjectController@update` | Save updated project |
| `instructor.projects.destroy` | DELETE | `/instructor/class/{classId}/projects/{projectId}` | `InstructorProjectController@destroy` | Delete a project |
| `instructor.tasks.ledger` | GET | `/instructor/class/{classId}/task-ledger` | `InstructorTaskLedgerController@index` | View task ledger page |
| `instructor.tasks.ledger.data` | GET | `/instructor/class/{classId}/task-ledger/data` | `InstructorTaskLedgerController@data` | JSON data for auto-refresh |

---

## 🧠 Concepts to Master (by difficulty)

| Concept | Used In | Difficulty |
|---|---|---|
| `Auth::id()` — gets the logged-in user's ID | All controllers | ⭐ Easy |
| `->firstOrFail()` — finds record or shows 404 | All controllers | ⭐ Easy |
| `->where()` chaining — filtering database queries | All controllers | ⭐ Easy |
| `->compact()` — passing data to views | All controllers | ⭐ Easy |
| `->latest()` — orders results newest first | Dashboard, Projects | ⭐⭐ Easy |
| `->with()` eager loading — load relationships upfront | Groups, Ledger | ⭐⭐ Medium |
| `->syncWithoutDetaching()` — add without removing | Roster Import | ⭐⭐ Medium |
| `->sync()` — replace all relationships | Projects | ⭐⭐⭐ Medium |
| `DB::transaction()` — all-or-nothing database safety | Groups | ⭐⭐⭐ Medium |
| CSV parsing with `fgetcsv()` | Roster Import | ⭐⭐⭐ Medium |
| Nested `foreach` loops for building table rows | Task Ledger | ⭐⭐⭐⭐ Hard |
| Null-safe operator `?->` | Task Ledger | ⭐⭐⭐ Medium |
| Modulo `%` for round-robin group distribution | Auto Grouping | ⭐⭐⭐⭐ Hard |
| Dual endpoints (HTML + JSON) for live refresh | Task Ledger | ⭐⭐⭐⭐⭐ Hard |

---

## 🗂️ File Reference

| File | Purpose |
|---|---|
| [`InstructorDashboardController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorDashboardController.php) | Dashboard + Archive logic |
| [`InstructorClassController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorClassController.php) | Class detail + CSV import logic |
| [`InstructorGroupController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorGroupController.php) | Manual + auto group assignment logic |
| [`InstructorProjectController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorProjectController.php) | Full CRUD for projects |
| [`InstructorTaskLedgerController.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/app/Http/Controllers/InstructorTaskLedgerController.php) | Task ledger (read-only report + JSON API) |
| [`views/instructor/dashboard.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/dashboard.blade.php) | Dashboard HTML |
| [`views/instructor/archive.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/archive.blade.php) | Archive HTML |
| [`views/instructor/course-detail.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/course-detail.blade.php) | Class detail HTML |
| [`views/instructor/groups.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/groups.blade.php) | Groups management HTML |
| [`views/instructor/projects/index.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/projects/index.blade.php) | Projects list HTML |
| [`views/instructor/projects/create.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/projects/create.blade.php) | Create project form HTML |
| [`views/instructor/projects/edit.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/projects/edit.blade.php) | Edit project form HTML |
| [`views/instructor/tasks/ledger.blade.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/resources/views/instructor/tasks/ledger.blade.php) | Task ledger table HTML |
| [`routes/web.php`](file:///c:/Apache%20&%20php/phpsite/Capstone/routes/web.php) | All URL route definitions |
