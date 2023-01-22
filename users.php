<?php include("./addons/Session.php") ?>
<?php include("./middleware/auth.middleware.php") ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dashboard - Users</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="./assets/style.311cc0a03ae53c54945b.css" rel="stylesheet">
</head>

<body class="font-inter antialiased bg-gray-100 text-gray-600" :class="{ 'sidebar-expanded': sidebarExpanded }"
    x-data="{ page: 'dashboard', sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }"
    x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">
    <script>localStorage.setItem('sidebar-expanded', 'true')</script>
    <script>if (localStorage.getItem('sidebar-expanded') == 'true') {
            document.querySelector('body').classList.add('sidebar-expanded');
        } else {
            document.querySelector('body').classList.remove('sidebar-expanded');
        }</script>
    <div class="flex h-screen overflow-hidden">
       <?php include("./inc/Sidebar.php") ?>
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
            <?php include("./inc/Header.php"); ?>
            <main>
                <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

                </div>
            </main>
        </div>
    </div>
    <script src="./assets/main.75545896273710c7378c.js"></script>
</body>

</html>