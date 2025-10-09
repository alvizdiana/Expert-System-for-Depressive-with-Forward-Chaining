<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/empartimg.png" type="image/png" alt="EmPart-Logo">
    <title>EmPart System</title>

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Creepster&display=swap" rel="stylesheet">

    <!-- font awsome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer">

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- my CSS -->
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <header class="navbar-container">
        <div class="logo">
            <a href="/">
                <img src="/img/empartsyst.png">
            </a>
        </div>
        <nav class="nav-list">
            <ul>
                <?php if (!session()->get('logged_in')) : ?>
                    <!-- Jika belum login -->
                    <li><a href="/register">Register</a></li>
                    <li><a href="/login">Login</a></li>
                <?php else : ?>
                    <!-- Jika sudah login -->
                    <ul>
                        <?php if (logged_in() && in_groups('admin')): ?>
                            <li><a href="/dbadmin">Admin Dashboard</a></li>
                        <?php elseif (logged_in() && in_groups('user')): ?>
                            <li><a href="/dbuser">Dashboard</a></li>
                        <?php else: ?>
                            <li><a href="/login">Login</a></li> <!-- Tautan untuk pengguna yang tidak terautentikasi -->
                        <?php endif; ?>
                    </ul>
                    <li><a href="/logout" data-toggle="modal" data-target="#logoutModal">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <?= $this->renderSection('content'); ?>

    <footer>
        <span>Copyright &copy; Alvi Zumaela Izdiana</span>
    </footer>

    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-custom-green" href="/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>