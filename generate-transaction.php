<?php $LINK = "transactions"; ?>
<?php include("./config/index.php") ?>
<?php include("./middleware/auth.middleware.php") ?>
<?php include("./inc/banks.php"); ?>
<?php $ACCOUNTS = getAllAccounts($TOKEN); ?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Dashboard - Generate Transactions</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="./assets/style.311cc0a03ae53c54945b.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/date/jquery.datetimepicker.min.css">
  <script src="./assets/jquery.js"></script>
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
          <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
              <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">Generate Transactions</h1>
            </div>
            <div class="grid grid-flow-col sm:auto-cols-max justify-start sm:justify-end gap-2">
              <!-- <form class="relative">
                <label for="action-search" class="sr-only">Search</label>
                <input id="action-search" class="form-input pl-9 focus:border-gray-300" name="search" type="search" placeholder="Search…" />
                <button class="absolute inset-0 right-auto group" type="submit" aria-label="Search">
                  <svg class="w-4 h-4 shrink-0 fill-current text-gray-400 group-hover:text-gray-500 ml-3 mr-2" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zM7 2C4.243 2 2 4.243 2 7s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5z" />
                    <path d="M15.707 14.293L13.314 11.9a8.019 8.019 0 01-1.414 1.414l2.393 2.393a.997.997 0 001.414 0 .999.999 0 000-1.414z" />
                  </svg>
                </button>
                <button class="btn bg-indigo-500 hover:bg-indigo-600 text-white"> <span class="hidden xs:block ml-2">Search</span></button>
              </form> -->
            </div>
          </div>

          <div class="col-span-full bg-white shadow-lg p-6 pb-8 rounded-sm border border-gray-200">
            <form action="./controllers/account.controller.php" method="POST" class="grid grid-cols-12 w-full gap-4">
              <div class="col-span-full sm:col-span-6">
                <label for="account" class="mb-1 font-bold flex text-xs text-gray-500">User</label>
                <select name="account" id="account" class="form-input w-full">
                  <option value="" selected disabled>Select user</option>
                  <?php foreach ($ACCOUNTS as $user) : ?>
                    <option value="<?= $user['accountNumber'] . "-" . $user['_id']; ?>">
                      <?= $user['user']["name"]; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-span-full sm:col-span-6">
                <label for="type" class="mb-1 font-bold flex text-xs text-gray-500">Transaction Type</label>
                <select name="type" id="type" class="form-input w-full">
                  <option value="" selected disabled>Select user</option>
                  <?php foreach ($transaction_types as $type) : ?>
                    <option value="<?= $type; ?>">
                      <?= $type; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-span-full sm:col-span-6">
                <label for="amount" class="mb-1 font-bold flex text-xs text-gray-500">Amount</label>
                <input type="number" name="amount" id="amount" placeholder="100" class="form-input w-full">
              </div>

              <div class="col-span-full sm:col-span-6">
                <label for="bank" class="mb-1 font-bold flex text-xs text-gray-500">Beneficiary Bank</label>
                <input type="text" name="bank" id="bank" placeholder="American Express" list="banks" class="form-input w-full">
                <datalist id="banks">
                  <?php foreach ($banks as $bank): ?>
                    <option value="<?= $bank; ?>"></option>
                  <?php endforeach; ?>
                </datalist>
              </div>

              <div class="col-span-full sm:col-span-6">
                <label for="name" class="mb-1 font-bold flex text-xs text-gray-500">Beneficiary Name</label>
                <input type="text" name="name" id="name" placeholder="John Smith" class="form-input w-full">
              </div>

              <div class="col-span-full sm:col-span-6">
                <label for="receiver" class="mb-1 font-bold flex text-xs text-gray-500">Beneficiary Account Number</label>
                <input type="text" name="receiver" id="receiver" placeholder="1234567890" class="form-input w-full">
              </div>

              <div class="col-span-full sm:col-span-6">
                <label for="description" class="mb-1 font-bold flex text-xs text-gray-500">Description</label>
                <textarea name="description" id="description" placeholder="Paying off debt" class="form-input w-full"></textarea>
              </div>

              <div class="col-span-full sm:col-span-6">
                <label for="date" class="mb-1 font-bold flex text-xs text-gray-500">Date</label>
                <input type="text" name="date" id="date" placeholder="2023/02/20 08:51" class="form-input date-picker w-full">
              </div>

              <div class="col-span-full">
                <button name="generate" class="btn bg-indigo-500 hover:bg-indigo-600 text-white">Generate</button>
              </div>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script src="./assets/main.75545896273710c7378c.js"></script>
  <script src="./assets//date/jquery.datetimepicker.full.min.js"></script>

  <script>
    $('.date-picker').datetimepicker();
  </script>
</body>

</html>