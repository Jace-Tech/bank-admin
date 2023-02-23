<?php $LINK = "users"; ?>
<?php include("./config/index.php") ?>
<?php include("./middleware/auth.middleware.php") ?>

<?php if (!isset($_GET['user'])) header("Location: ./users"); ?>
<?php 
$USER = getUserAccount($TOKEN, $_GET['user']);
if (!$USER) header("Location: ./users");

if(isset($_GET['active']) && $_GET['active'] == "transaction") {
  $ALL_TRANSACTIONS = getUsersTransactions($TOKEN, $_GET['user']) ?? [];
}

if(isset($_GET['active']) && $_GET['active'] == "loan") {
  $LOANS = getUsersLoan($TOKEN, $_GET['user']) ?? [];
}

if(isset($_GET['active']) && $_GET['active'] == "allowed") {
  $ALLOWED_LIST = getAllUserAllowedList($TOKEN, $_GET['user']) ?? [];
}


function checkActive ($active) {
  $class_active = "block pb-3 whitespace-nowrap text-indigo-500 border-b-2 border-indigo-500";
  $class_inactive = "block pb-3 text-gray-500 hover:text-gray-600 whitespace-nowrap";

  if(isset($_GET['active']) && $_GET['active'] == $active){
    return $class_active;
  }

  else if(isset($_GET['active']) && $_GET['active'] !== $active) {
    return $class_inactive;
  }

  else if(!isset($_GET['active']) && $active == "account") {
    return $class_active;
  }
  
  else {
    return $class_inactive;
  }
}
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Dashboard - <?= $USER["user"]['name']; ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="./assets/style.311cc0a03ae53c54945b.css" rel="stylesheet">
</head>

<body class="font-inter antialiased bg-gray-100 text-gray-600" :class="{ 'sidebar-expanded': sidebarExpanded }" x-data="{ page: 'dashboard', sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }" x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">
  <script>
    localStorage.setItem('sidebar-expanded', 'true')
  </script>
  <script>
    if (localStorage.getItem('sidebar-expanded') == 'true') {
      document.querySelector('body').classList.add('sidebar-expanded');
    } else {
      document.querySelector('body').classList.remove('sidebar-expanded');
    }
  </script>
  <div class="flex h-screen overflow-hidden">
    <?php include("./inc/Sidebar.php") ?>
    <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
      <?php include("./inc/Header.php"); ?>
      <main>
        <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
          <div class="mb-8">
            <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">User Details</h1>
          </div>
          <div class="bg-white shadow-lg rounded-sm mb-8">
            <div class="flex flex-col md:flex-row md:-mr-px">
              <div class="grow">
                <div class="p-6 space-y-6">
                  <section class="grid grid-flow-col sm:auto-cols-max justify-start gap-2 mb-8">
                    <div class="col-span-12 md:col-span-4">
                      <div class="flex items-center">
                        <div class="mr-4">
                          <?php if ($USER['user']['image']) : ?>
                            <img class="w-20 h-20 rounded-full" src="./assets/images/user-avatar-80.png" width="80" height="80" alt="User upload" />
                        </div>
                      <?php else : ?>
                        <img class="w-20 h-20 rounded-full" src="./assets/images/user-avatar-80.png" width="80" height="80" alt="User upload" />
                      </div>
                    <?php endif; ?>
                    </div>
                </div>

                <div class="col-span-12 md:col-span-6">
                  <h3 class="text-xl leading-snug text-gray-800 font-bold mb-1"> <?= $USER["user"]['name']; ?></h3>
                  <div class="flex flex-col mt-2">
                    <div class="flex items-center gap-2">
                      <p class="text-sm text-gray-500 font-semibold">Account Type: </p>
                      <p class="text-sm text-gray-500"><?= $USER['accountType']; ?></p>
                    </div>

                    <div class="flex items-center mt-2 gap-2">
                      <p class="text-sm text-gray-500 font-semibold">Account Number: </p>
                      <p class="text-sm text-gray-500"><?= $USER['accountNumber']; ?></p>
                    </div>

                    <div class="flex items-center mt-2 gap-2">
                      <p class="text-sm text-gray-500 font-semibold">Account Balance: </p>
                      <p class="text-lg text-gray-500 font-bold"><?= "$" . $USER['balance']; ?></p>
                    </div>
                  </div>
                </div>
                </section>

                <section>
                  <div>
                    <div class="relative mb-8">
                      <div class="absolute bottom-0 w-full h-px bg-gray-200" aria-hidden="true"></div>
                      <ul class="relative text-sm font-medium flex flex-nowrap -mx-4 sm:-mx-6 lg:-mx-8 overflow-x-scroll no-scrollbar">

                        <li class="mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8"><a class="<?= checkActive("account"); ?>" href="./user-details?user=<?= $_GET['user']; ?>">Account</a></li>
                        <li class="mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8"><a class="<?= checkActive("transaction") ?>" href="./user-details?user=<?= $_GET['user']; ?>&active=transaction">Transactions</a></li>
                        <li class="mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8"><a class="<?= checkActive("allowed") ?>" href="./user-details?user=<?= $_GET['user']; ?>&active=allowed">Allowed List</a></li>
                        <li class="mr-6 last:mr-0 first:pl-4 sm:first:pl-6 lg:first:pl-8 last:pr-4 sm:last:pr-6 lg:last:pr-8"><a class="<?= checkActive("loan") ?>" href="./user-details?user=<?= $_GET['user']; ?>&active=loan">Loans</a></li>
                      </ul>
                    </div>
                  </div>
                </section>

                <?php if(isset($_GET['active']) && $_GET['active'] == "transaction"): ?>
                  <?php include("./components/transaction-info.php"); ?>
                <?php elseif(isset($_GET['active']) && $_GET['active'] == "allowed"): ?>
                  <?php include("./components/allowed-info.php"); ?>
                <?php elseif(isset($_GET['active']) && $_GET['active'] == "loan"): ?>
                  <?php include("./components/loan-info.php"); ?>
                <?php else: ?>
                  <?php include("./components/account-info.php"); ?>
                <?php endif;  ?>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="./assets/main.75545896273710c7378c.js"></script>
</body>

</html>