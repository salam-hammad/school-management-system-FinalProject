<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            {{-- <a href="{{ url('/dashboard') }}"> --}}
            <a href="{{ route('dashboard.Students') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('main_trans.Programname') }} </li>



        <!-- المواد الدراسية -->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#subjects-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span
                        class="right-nav-text">{{ trans('main_trans.Study_materials') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="subjects-icon" class="collapse" data-parent="#sidebarnav">
                <li>
                    <a href="{{ route('student.subjects.index') }}">{{ trans('Students_trans.Subject_List') }}</a>
                </li>
            </ul>
        </li>

        <!-- الحصص الأونلاين-->
        <li>
            <a href=""><i class="fas fa-book-open"></i><span class="right-nav-text">الحصص الأونلاين</span></a>

            {{-- <a href="{{route('student_exams.index')}}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">الامتحانات</span></a>                     --}}
        </li>


<!-- المكتبة -->
<li>
    <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-menu">
        <div class="pull-left">
            <i class="fas fa-book-open"></i>
            <span class="right-nav-text">المكتبة</span>
        </div>
        <div class="pull-right">
            <i class="ti-plus"></i>
        </div>
        <div class="clearfix"></div>
    </a>
    <ul id="library-menu" class="collapse" data-parent="#sidebarnav">
        <!-- قائمة الكتب المدرسية -->
        <li>
            <a href="{{ route('student.library.index') }}">
                <i class="fas fa-book"></i>
                <span class="right-nav-text">قائمة الكتب المدرسية</span>
            </a>
        </li>

        <!-- الكتب المحملة -->
        <li>
            <a href="{{ route('student.library.downloaded') }}">
                <i class="fas fa-download"></i>
                <span class="right-nav-text">الكتب المحملة</span>
            </a>
        </li>

        <!-- البحث في المكتبة -->
        <li>
            <a href="{{ route('student.library.search') }}">
                <i class="fas fa-search"></i>
                <span class="right-nav-text">بحث في المكتبة</span>
            </a>
        </li>
    </ul>
</li>




        <!-- الامتحانات-->
        <li>
            <a href="{{ route('student_exams.index') }}"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">الامتحانات</span></a>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{ route('profile.index') }}"><i class="fas fa-id-card-alt"></i><span class="right-nav-text">الملف
                    الشخصي</span></a>
        </li>

    </ul>
</div>
