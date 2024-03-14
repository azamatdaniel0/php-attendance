<nav class="navbar navbar-expand-lg navbar-light bg-primary sticky-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="./">
        <img src="assets/logo.png" alt="" width="50" height="50" class="d-inline-block align-text-top">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link active" href="./">Система управления посещаемостью</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($page)) && $page == 'home' ? 'active' : '' ?>" href="./">Студенты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($page)) && $page == 'class_list' ? 'active' : '' ?>" href="./?page=class_list">Класс</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($page)) && $page == 'attendance' ? 'active' : '' ?>" href="./?page=attendance">Посещаемость</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($page)) && $page == 'attendance_report' ? 'active' : '' ?>" href="./?page=attendance_report">Отчет</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>