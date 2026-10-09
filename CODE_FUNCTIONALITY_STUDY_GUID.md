# Instructor Side Code Functionality Study Guide

This study guide explains the major instructor-facing features in the Capstone system, what code calls them, how each feature relates to the overall system, and which parts are backend vs frontend.

---

## 1. Purpose of the Instructor Side

The instructor side is the management and supervisory layer of the Capstone project. It is used by users with the role **Instructor** to:

- View their assigned course sections and classrooms
- Open a class detail page to review enrolled students
- Import students into a class using a CSV roster
- Create and manage student groups (manually via drag-and-drop or automatically via randomized round-robin distribution)
- Create and manage projects assigned to student groups
- Monitor tasks, deliverables, submissions, point weightage, and approval statuses via the live Task Ledger

### Relationship to the Full System

- **Admin**: Manages system structure, user accounts, and class allocations.
- **Instructor**: Manages class-level operations, student rosters, team formations, project definitions, and grade/submission oversight.
- **Students**: Belong to classes and groups, collaborate on project tasks, and submit deliverables.
- **Projects**: Created by instructors and assigned to student groups.
- **Tasks**: Created under projects and assigned to student group members.

In short, the instructor side acts as the bridge between administrative classroom setup and student teamwork.

---

## 2. Main Instructor Route Groups

Main route file:
- `routes/web.php`

All instructor routes are protected under:
```php
Route::middleware(['auth', 'role:Instructor'])->group(function () {
    // Instructor Routes
});
```

This guarantees:
- The user is authenticated (`auth` middleware).
- The user has the `Instructor` role (`role:Instructor` middleware).
- In addition, all controller actions strictly filter by `where('Instructor_Id', Auth::id())` to prevent unauthorized cross-instructor access.

### Instructor Route Summary

| Feature | HTTP Method & URI | Named Route | Controller Action | View / UI |
|---|---|---|---|---|
| **Dashboard** | `GET /teacher` | `instructor.dashboard` | `InstructorDashboardController@index` | `resources/views/instructor/dashboard.blade.php` |
| **Class Detail / Config** | `GET /instructor/class/{classId}` | `instructor.class.configure` | `InstructorClassController@show` | `resources/views/instructor/course-detail.blade.php` |
| **Import Roster** | `POST /instructor/class/{classId}/roster/import` | `instructor.class.roster.import` | `InstructorClassController@importRoster` | CSV upload modal |
| **Groups Page** | `GET /instructor/class/{classId}/groups` | `instructor.class.groups` | `InstructorGroupController@index` | `resources/views/instructor/groups.blade.php` |
| **Manual Group Save** | `POST /instructor/class/{classId}/groups/manual` | `instructor.class.groups.manual` | `InstructorGroupController@saveManual` | Drag-and-drop grouping form |
| **Automatic Group Save** | `POST /instructor/class/{classId}/groups/automatic` | `instructor.class.groups.automatic` | `InstructorGroupController@automatic` | Modulo round-robin generation form |
| **Projects List** | `GET /instructor/class/{classId}/projects` | `instructor.projects.index` | `InstructorProjectController@index` | `resources/views/instructor/projects/index.blade.php` |
| **Create Project Page** | `GET /instructor/class/{classId}/projects/create` | `instructor.projects.create` | `InstructorProjectController@create` | `resources/views/instructor/projects/create.blade.php` |
| **Store Project** | `POST /instructor/class/{classId}/projects` | `instructor.projects.store` | `InstructorProjectController@store` | Project form submission + group sync |
| **Edit Project Page** | `GET /instructor/class/{classId}/projects/{projectId}/edit` | `instructor.projects.edit` | `InstructorProjectController@edit` | `resources/views/instructor/projects/edit.blade.php` |
| **Update Project** | `PUT /instructor/class/{classId}/projects/{projectId}` | `instructor.projects.update` | `InstructorProjectController@update` | Project edit submission + group sync |
| **Delete Project** | `DELETE /instructor/class/{classId}/projects/{projectId}` | `instructor.projects.destroy` | `InstructorProjectController@destroy` | Project deletion |
| **Task Ledger** | `GET /instructor/class/{classId}/task-ledger` | `instructor.tasks.ledger` | `InstructorTaskLedgerController@index` | `resources/views/instructor/tasks/ledger.blade.php` |
| **Task Ledger JSON API** | `GET /instructor/class/{classId}/task-ledger/data` | `instructor.tasks.ledger.data` | `InstructorTaskLedgerController@data` | Live JSON polling endpoint |

---

## 3. Core Models Behind Instructor Features

These Eloquent models are the main building blocks:

- `app/Models/ClassRoom.php`
  - Represents a class or course section.
  - Columns: `course_code`, `course_name`, `offer_code` (renamed from `section`), `semester`, `academic_year`, `Instructor_Id`.
  - Belongs to an instructor (`User`).
  - Has many students (via `class_student` pivot), groups (`Group`), and projects (`Project`).

- `app/Models/Group.php`
  - Represents a student project team in a class.
  - Belongs to `ClassRoom`.
  - Belongs to many students via `group_members` pivot with `is_leader` flag.
  - Belongs to many projects via `project_groups` pivot table.

- `app/Models/Project.php`
  - Represents a milestone or term project inside a classroom.
  - Belongs to `ClassRoom`.
  - Belongs to many groups via `project_groups` pivot table.
  - Has many tasks (`Task`).

- `app/Models/Task.php`
  - Represents an assignment or deliverable work item inside a project.
  - Belongs to `Project` and `Group`.
  - Has many assignments (`TaskAssignment`) and submissions (`TaskSubmission`).

- `app/Models/TaskSubmission.php`
  - Records student submissions with `submission_text`, `file_path`, `status` (`Pending`, `Approved`, `Rejected`), `submitted_at`, `approved_at`, `approved_by`, and `feedback`.
  - Belongs to `Task`, student (`User`), and approver (`User`).

- `app/Models/User.php`
  - Stores instructors, students, and admins (`role` column).
  - Contains student identification (`student_id`).

### Relationship Summary

- `ClassRoom` has many `students` (via `class_student`)
- `ClassRoom` has many `groups`
- `ClassRoom` has many `projects`
- `Group` has many `students` (via `group_members`)
- `Group` has many `projects` (via `project_groups`)
- `Project` has many `groups` (via `project_groups`)
- `Project` has many `tasks`
- `Task` has many `assignments` (`TaskAssignment`)
- `Task` has many `submissions` (`TaskSubmission`)

---

## 4. Feature 1: Instructor Dashboard

### Functionality
Displays all classrooms assigned to the logged-in instructor with aesthetic card styling, quick stats, and navigation to class management.

### Code Call Path
- **Route**: `GET /teacher` (`instructor.dashboard` in `routes/web.php`)
- **Controller**: `app/Http/Controllers/InstructorDashboardController.php`
- **View**: `resources/views/instructor/dashboard.blade.php`
- **Model**: `app/Models/ClassRoom.php`

### Backend Logic
```php
public function index() {
    $classes = Classroom::where('Instructor_Id', Auth::id())
        ->latest()
        ->get();

    return view('instructor.dashboard', compact('classes'));
}
```

What it does:
- Queries `class_rooms` where `Instructor_Id` matches the authenticated instructor (`Auth::id()`).
- Orders classes by newest first (`->latest()`).
- Returns `instructor.dashboard` passing `$classes`.

### Frontend
- Renders responsive classroom cards with gradient themes.
- Displays `course_name`, `course_code`, `offer_code`, `semester`, and `academic_year`.
- Provides direct link to configure class (`route('instructor.class.configure', $class->id)`).

---

## 5. Feature 2: Class Detail & CSV Student Roster Import

### Functionality
Displays class overview and enrolled students, allowing the instructor to upload a CSV file to enroll registered student accounts.

### Code Call Path
- **Routes**:
  - `GET /instructor/class/{classId}` (`instructor.class.configure`)
  - `POST /instructor/class/{classId}/roster/import` (`instructor.class.roster.import`)
- **Controller**: `app/Http/Controllers/InstructorClassController.php`
- **View**: `resources/views/instructor/course-detail.blade.php`
- **Models**: `app/Models/ClassRoom.php`, `app/Models/User.php`

### Backend Logic
```php
public function show($classId) {
    $class = ClassRoom::where('id', $classId)
        ->where('Instructor_Id', Auth::id())
        ->with('students')
        ->firstOrFail();

    return view('instructor.course-detail', compact('class'));
}

public function importRoster(Request $request, $classId) {
    $class = ClassRoom::where('id', $classId)
        ->where('Instructor_Id', Auth::id())
        ->firstOrFail();

    $request->validate([
        'roster' => 'required|file|mimes:csv,txt|max:2048'
    ]);

    $file = $request->file('roster');
    $handle = fopen($file->getRealPath(), 'r');

    if (!$handle) {
        return back()->with('error', 'Unable to read the CSV file.');
    }

    $header = fgetcsv($handle);
    if (!$header) {
        fclose($handle);
        return back()->with('error', 'The CSV file is empty.');
    }

    $header = array_map(function ($value) {
        return trim(str_replace("\xEF\xBB\xBF", '', $value));
    }, $header);

    $requiredColumns = ['student_id', 'name', 'email'];
    foreach ($requiredColumns as $column) {
        if (!in_array($column, $header)) {
            fclose($handle);
            return back()->with('error', "Missing required column: {$column}");
        }
    }

    $imported = 0;
    $skipped = 0;

    while (($row = fgetcsv($handle)) !== false) {
        if (count(array_filter($row)) === 0) continue;
        if (count($row) !== count($header)) {
            $skipped++;
            continue;
        }

        $data = array_combine($header, $row);
        $studentId = trim($data['student_id'] ?? '');
        $email = trim($data['email'] ?? '');

        if (!$studentId || !$email) {
            $skipped++;
            continue;
        }

        $student = User::where('student_id', $studentId)
            ->where('role', 'Student')
            ->first();

        if (!$student) {
            $skipped++;
            continue;
        }

        $class->students()->syncWithoutDetaching([$student->id]);
        $imported++;
    }

    fclose($handle);

    return back()->with(
        'success',
        "{$imported} student(s) imported successfully. {$skipped} row(s) skipped."
    );
}
```

What it does:
- Validates file size and CSV format.
- Strips UTF-8 Byte Order Mark (BOM `\xEF\xBB\xBF`).
- Checks for required columns (`student_id`, `name`, `email`).
- Matches each row to an existing `Student` user account.
- Attaches the student via `syncWithoutDetaching()` on the `class_student` pivot table.

---

## 6. Feature 3: Student Group Management (Manual & Automatic)

### Functionality
Enables instructors to organize enrolled students into project groups either via manual drag-and-drop or automated balanced grouping.

### Code Call Path
- **Routes**:
  - `GET /instructor/class/{classId}/groups` (`instructor.class.groups`)
  - `POST /instructor/class/{classId}/groups/manual` (`instructor.class.groups.manual`)
  - `POST /instructor/class/{classId}/groups/automatic` (`instructor.class.groups.automatic`)
- **Controller**: `app/Http/Controllers/InstructorGroupController.php`
- **View**: `resources/views/instructor/groups.blade.php`
- **Models**: `app/Models/ClassRoom.php`, `app/Models/Group.php`

### Backend Logic
- **`saveManual`**:
  - Validates `groups` array and member student IDs.
  - Uses `DB::transaction()`: deletes old class groups, creates new groups with sequential `group_number`, and attaches student IDs to `group_members` with default `is_leader = false`.
- **`automatic`**:
  - Takes `number_of_groups`.
  - Shuffles the student collection (`$students = $class->students->shuffle()->values()`).
  - Uses modulo round-robin (`$index % $numberOfGroups`) to evenly distribute students into balanced teams.

---

## 7. Feature 4: Project Management (Full CRUD with Group Assignment)

### Functionality
The instructor creates, edits, and deletes class projects and assigns them to selected student groups via the `project_groups` pivot table.

### Code Call Path
- **Routes**:
  - `GET /instructor/class/{classId}/projects` (`instructor.projects.index`)
  - `GET /instructor/class/{classId}/projects/create` (`instructor.projects.create`)
  - `POST /instructor/class/{classId}/projects` (`instructor.projects.store`)
  - `GET /instructor/class/{classId}/projects/{projectId}/edit` (`instructor.projects.edit`)
  - `PUT /instructor/class/{classId}/projects/{projectId}` (`instructor.projects.update`)
  - `DELETE /instructor/class/{classId}/projects/{projectId}` (`instructor.projects.destroy`)
- **Controller**: `app/Http/Controllers/InstructorProjectController.php`
- **Views**: `resources/views/instructor/projects/index.blade.php`, `create.blade.php`, `edit.blade.php`
- **Models**: `app/Models/Project.php`, `app/Models/Group.php`, `app/Models/ClassRoom.php`

### Backend Logic Highlights
- Validates project title, dates (`end_date >= start_date`), status (`Active`, `Draft`, `Completed`), and required `groups` array (`min:1`).
- Verifies selected group IDs belong to the class:
  ```php
  $validGroupIds = $class->groups()
      ->whereIn('groups.id', $request->groups)
      ->pluck('groups.id')
      ->toArray();
  ```
- Persists project and syncs group associations:
  ```php
  $project = Project::create([...]);
  $project->groups()->sync($validGroupIds);
  ```
- Eager loads `groups` relationship in `index` and `edit` views to display assigned groups and member counts.

---

## 8. Feature 5: Task Ledger & Real-Time Monitoring

### Functionality
Tracks all task assignments, student deliverables, points, submission timestamps, and approval statuses for the entire class, supporting client-side filtering and live AJAX polling every 10 seconds.

### Code Call Path
- **Routes**:
  - `GET /instructor/class/{classId}/task-ledger` (`instructor.tasks.ledger`)
  - `GET /instructor/class/{classId}/task-ledger/data` (`instructor.tasks.ledger.data`)
- **Controller**: `app/Http/Controllers/InstructorTaskLedgerController.php`
- **View**: `resources/views/instructor/tasks/ledger.blade.php`
- **Models**: `app/Models/Task.php`, `app/Models/TaskAssignment.php`, `app/Models/TaskSubmission.php`

### Backend Logic
```php
$tasks = Task::whereHas('project', function ($query) use ($class) {
        $query->where('class_room_id', $class->id);
    })
    ->with([
        'project',
        'group',
        'assignments.student',
        'submissions.student',
    ])
    ->latest()
    ->get();
```
- Flattens tasks into individual student assignment rows.
- Pairs each assignment with their latest `TaskSubmission` (sorted by `submitted_at`).
- `index()` renders the Blade view with summary KPIs (Total, Submitted, Pending, Approved).
- `data()` returns the exact payload as JSON for live client-side updates.

---

## 9. Backend vs. Frontend Architecture

### Backend Files
- `routes/web.php` &mdash; Routing and middleware guards (`auth`, `role:Instructor`).
- `app/Http/Controllers/Instructor*` &mdash; Business logic, validation, authorization checks (`Instructor_Id = Auth::id()`), and database queries.
- `app/Models/*` &mdash; Schema representations, relationships, fillable attributes, and date casts.
- `database/migrations/*` &mdash; Database schema tables, foreign keys, indexes, and constraints.

### Frontend Files
- `resources/views/instructor/*` &mdash; Blade templates with Tailwind CSS styling, responsive cards, KPI summaries, and modal dialogs.
- `resources/views/layouts/instructor.blade.php` &mdash; Instructor shell layout with navigation and sidebar.
- Client-side JS &mdash; Drag-and-drop grouping handlers, modal toggle scripts, live client-side table filters, and `setInterval` AJAX polling.

---

## 10. Exam & Defense Checklist

Be prepared to answer:
1. **Which route handles the instructor dashboard?** `GET /teacher` (`instructor.dashboard`).
2. **Which controller handles class detail & CSV import?** `InstructorClassController`.
3. **Which controller handles manual and automatic grouping?** `InstructorGroupController`.
4. **Which controller handles project CRUD operations?** `InstructorProjectController`.
5. **Which controller handles the task ledger?** `InstructorTaskLedgerController`.
6. **How are projects linked to groups?** Via the `project_groups` pivot table using `$project->groups()->sync($validGroupIds)`.
7. **Why is `where('Instructor_Id', Auth::id())` critical?** It enforces multi-tenant security and prevents Insecure Direct Object Reference (IDOR) attacks across instructors.
8. **What columns were added to `task_submissions`?** `submission_text` and `file_path`.
9. **What column was renamed in `class_rooms`?** `section` was renamed to `offer_code`.