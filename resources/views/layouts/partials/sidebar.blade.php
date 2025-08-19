<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Academics</div>
                {{-- Classes --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseclass">
                    <div class="sb-nav-link-icon"><i class="fas fa-chalkboard"></i></div>
                    Classes
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseclass" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('classroom.index')}}">📚 All Classes</a>
                        <a class="nav-link" href="{{route('classroom.create')}}">➕ Create Class</a>
                    </nav>
                </div>

                {{-- Sections --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsesection">
                    <div class="sb-nav-link-icon"><i class="fas fa-th-large"></i></div>
                    Sections
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsesection" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('sections.index')}}">📚 All Sections</a>
                        <a class="nav-link" href="{{route('sections.create')}}">➕ Create Section</a>
                    </nav>
                </div>

                {{-- Subjects --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsesubject">
                    <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                    Subjects
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsesubject" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('subject.index')}}">📚 All Subjects</a>
                        <a class="nav-link" href="{{route('subject.create')}}">➕ Create Subject</a>
                    </nav>
                </div>

                {{-- Assign Subjects --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseassign">
                    <div class="sb-nav-link-icon"><i class="fas fa-link"></i></div>
                    Assign Subjects
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseassign" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('assignedSubject.index')}}">🔗 All Assigned</a>
                        <a class="nav-link" href="{{route('assignedSubject.create')}}">➕ Assign Subject</a>
                    </nav>
                </div>

                {{-- Timetable --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsetimetable">
                    <div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
                    Timetable
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsetimetable" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('timetables.create')}}">📅 Create Timetable</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Students</div>
                {{-- Student Profile --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseStuProfile">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-graduate"></i></div>
                    Student Profile
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseStuProfile" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('student-profiles.create')}}">🡩‍🏫 Create Profile</a>
                    </nav>
                </div>

                {{-- Attendance --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAttendance">
                    <div class="sb-nav-link-icon"><i class="fas fa-check-square"></i></div>
                    Attendance
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAttendance" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('studentAttendance.index')}}">✅ Take Attendance</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Teachers</div>
                {{-- Teacher Profile --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseteacher">
                    <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-teacher"></i></div>
                    Teacher Profile
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseteacher" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('teachers.create')}}">👨‍🏫 Register Teacher</a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Exams</div>
                {{-- Exam Type --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseexamtype">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                    Exam Type
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseexamtype" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('exam-types.create')}}">📝 Create Type</a>
                        <a class="nav-link" href="{{route('exam-types.index')}}">📋 All Types</a>
                    </nav>
                </div>

                {{-- Exams --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseexam">
                    <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                    Exams
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseexam" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('exams.create')}}">🧾 Create Exam</a>
                    </nav>
                </div>

                {{-- Marks --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsmark">
                    <div class="sb-nav-link-icon"><i class="fas fa-pen-nib"></i></div>
                    Marks
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsmark" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('marks.create')}}">✏️ Enter Marks</a>
                    </nav>
                </div>

                {{-- Results --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseResult">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                    Results
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseResult" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('results.generate')}}">🎯 Generate Result</a>
                        <a class="nav-link" href="#">📋 All Results</a>
                        <a class="nav-link" href="#">📝 Manual Entry</a>
                    </nav>
                </div>

                {{--Fees--}}
                <div class="sb-sidenav-menu-heading">Fees</div>
                
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsefees">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                    Fees Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsefees" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('fee_category.create')}}">📝 Create Fee Category</a>
                        <a class="nav-link" href="{{route('fee_category.index')}}">📋 All Category</a>
                    </nav>
                </div>
                {{-- Fee type--}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsefeetype">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                    Fees Type
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsefeetype" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('fee_type.create')}}">📝 Create Fee Type</a>
                        <a class="nav-link" href="{{route('fee_category.index')}}">📋 All FeeType</a>
                    </nav>
                </div>
                {{-- Fee assign--}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsefeetype">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                    Fees Type
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsefeetype" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{route('fee_type.create')}}">📝 Submit Fee</a>
                        <a class="nav-link" href="{{route('fee_category.index')}}">📋 All FeeType</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
