<?php include("./config/index.php") ?>
<?php include("./middleware/auth.middleware.php") ?>

<?php $LOANS = getAllPendingLoan($TOKEN); ?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Dashboard - Pending Loans</title>
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
              <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">Pending Loans</h1>
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

          <div class="col-span-full bg-white shadow-lg rounded-sm border border-gray-200">
            <header class="px-5 py-4 border-b border-gray-100">
              <h2 class="font-semibold text-gray-800">Latest Loan Requests</h2>
            </header>
            <div class="p-3">
              <div class="overflow-x-auto">
                <table class="table-auto w-full">
                  <thead class="text-xs uppercase text-gray-400 bg-gray-50 rounded-sm">
                    <tr>
                      <th class="p-2">
                        <div class="font-semibold text-left">Loan ID</div>
                      </th>

                      <th class="p-2">
                        <div class="font-semibold text-left">User</div>
                      </th>

                      <th class="p-2">
                        <div class="font-semibold text-left">Amount</div>
                      </th>

                      <th class="p-2">
                        <div class="font-semibold text-center">Status</div>
                      </th>

                      <th class="p-2">
                        <div class="font-semibold text-left">Interest</div>
                      </th>

                      <th class="p-2">
                        <div class="font-semibold text-left">Due Date</div>
                      </th>

                      <th class="p-2">
                        <div class="font-semibold text-right"></div>
                      </th>

                      <th class="p-2">
                        <div class="font-semibold text-right"></div>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="text-sm font-medium divide-y divide-gray-100">
                    <?php if (count($LOANS)) : ?>
                      <?php foreach ($LOANS as $loan) : ?>
                        <tr>
                          <td class="p-3">
                            <div class="text-xs text-gray-500 ">
                              <?= "Lns_" . $loan["_id"] ?>
                            </div>
                          </td>
                          <td class="p-3">
                          <?php if($loan["user"] && $loan["user"]['_id'] !== $ADMIN["_id"]): ?>
                              <a href="user-details?user=<?= $loan["user"]['_id'] ?>" class="text-xs text-left text-gray-500 whitespace-nowrap">
                                <?= $loan["user"]["name"] ?? "<i>NILL</i>" ?>
                              </a>
                            <?php else: ?>
                              <div class="text-xs text-left text-gray-500 whitespace-nowrap">
                                <?= $loan["user"]["name"] ?? "<i>NILL</i>" ?>
                              </div>
                            <?php endif; ?>
                          </td>

                          <td class="p-3">
                            <div class="text-xs text-left text-gray-500 whitespace-nowrap">
                              <?= "$" . $loan["amount"] ?>
                            </div>
                          </td>

                          <td class="p-3">
                            <div class="text-xs text-center text-gray-500">
                              <span style="width: fit-content;" class="text-xs px-2 py-1 rounded-full flex mx-auto items-center justify-center <?= getLoanColor($loan["status"]) ?>">
                                <?= $loan["status"]; ?>
                              </span>
                            </div>
                          </td>

                          <td class="p-3">
                            <div class="text-xs text-gray-500 <?=  !$loan['interest'] ? "text-center" : "text-left" ?>">
                              <?= $loan['interest'] ? ("$" . $loan["interest"]) : "- - -";  ?>
                            </div>
                          </td>
                          
                          <td class="p-3">
                            <div class="text-xs text-gray-500 whitespace-nowrap <?=  !$loan['endDate'] ? "text-center" : "text-left" ?>">
                              <?= $loan['endDate'] ? date("D d, M Y - H:m A", strtotime($loan["endDate"])) : "- - -";  ?>
                            </div>
                          </td>

                          <td class="p-3">
                            <div class="flex gap-2">
                              <!-- DELETE PART -->
                              <?php include("./components/loanDelete.php"); ?>
                              <!-- DELETE PART -->

                              <?php if($loan['status'] == "pending"): ?>
                              <!-- APPROVE PART -->
                              <?php include("./components/loanApprove.php"); ?>
                              <!-- APPROVE PART -->
                              <?php endif; ?>
                              <!-- CANCEL PART -->
                              <?php include("./components/cancelLoan.php"); ?>
                              <!-- CANCEL PART -->
                            </div>
                          </td>
                          <td></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td class="p-2 py-8" colspan="6">
                          <div class="text-left text-center text-gray-400">No loans Found</div>
                        </td>
                      </tr>
                    <?php endif; ?>

                  </tbody>
                </table>
              </div>
            </div>
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