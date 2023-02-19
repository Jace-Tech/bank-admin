<?php include("./config/index.php") ?>
<?php include("./middleware/auth.middleware.php") ?>

<?php $ALL_TRANSACTIONS = getAllApprovedTransactions($TOKEN);?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Dashboard - Approved Transactions</title>
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
              <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">Approved Transactions</h1>
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
              <h2 class="font-semibold text-gray-800">Latest Transactions</h2>
            </header>
            <div class="p-3">
              <div class="overflow-x-auto">
                <table class="table-auto w-full">
                  <thead class="text-xs uppercase text-gray-400 bg-gray-50 rounded-sm">
                    <tr>
                      <th class="p-2">
                        <div class="font-semibold text-left">Transaction ID</div>
                      </th>
                      <th class="p-2">
                        <div class="font-semibold text-left">Sender</div>
                      </th>
                      <th class="p-2">
                        <div class="font-semibold text-left">Recipient</div>
                      </th>
                      <th class="p-2">
                        <div class="font-semibold text-left">Amount</div>
                      </th>
                      <th class="p-2">
                        <div class="font-semibold text-center">Status</div>
                      </th>

                      <th class="p-2">
                        <div class="font-semibold text-left">Type</div>
                      </th>

                      <th class="p-2">
                        <div class="font-semibold text-left">Date</div>
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
                    <?php if (count($ALL_TRANSACTIONS)) : ?>
                      <?php foreach ($ALL_TRANSACTIONS as $transaction) : ?>
                        <tr>
                          <td class="p-3">
                            <div class="text-xs text-gray-500">
                              <?= "Trx_" . $transaction["_id"] ?>
                            </div>
                          </td>
                          <td class="p-3">
                          <?php if($transaction["sender"] && $transaction["sender"]['_id'] !== $ADMIN["_id"]): ?>
                              <a href="user-details?user=<?= $transaction["sender"]['_id'] ?>" class="text-xs text-left text-gray-500 whitespace-nowrap">
                                <?= $transaction["sender"]["accountName"] ?? "<i>NILL</i>" ?>
                              </a>
                            <?php else: ?>
                              <div class="text-xs text-left text-gray-500 whitespace-nowrap">
                                <?= $transaction["sender"]["accountName"] ?? "<i>NILL</i>" ?>
                              </div>
                            <?php endif; ?>
                          </td>
                          <td class="p-3">
                            <div class="text-xs text-left text-gray-500">
                              <?= $transaction["beneficiaryName"] ?? $transaction['receiver'];  ?>
                            </div>
                          </td>
                          <td class="p-3">
                            <div class="text-xs text-left text-gray-500">
                              <?= "$" . $transaction["amount"];  ?>
                            </div>
                          </td>
                          <td class="p-3">
                            <div class="text-xs text-center text-gray-500">
                              <span style="width: fit-content;" class="text-xs px-2 py-1 rounded-full flex mx-auto items-center justify-center <?= getStatsColor($transaction["status"]) ?>">
                                <?= $transaction["status"]; ?>
                              </span>
                            </div>
                          </td>
                          <td class="p-3">
                            <div class="text-xs text-left text-gray-500">
                              <?= $transaction["type"];  ?>
                            </div>
                          </td>
                          <td class="p-3">
                            <div class="text-xs text-left text-gray-500 whitespace-nowrap">
                              <?= date("D d, M Y - H:m A", strtotime($transaction["date"]));  ?>
                            </div>
                          </td>

                          <td class="p-3">
                            <div class="flex gap-2">
                              <!-- DELETE PART -->
                              <div x-data="{ modalOpen: false }">
                                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                                  <button name="delete" value="<?= $transaction['_id']; ?>" class="btn btn-xs" @click.prevent="modalOpen = true" aria-controls="danger-modal-delete-<?= $transaction['_id']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M4 7h16" />
                                      <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                      <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                      <path d="M10 12l4 4m0 -4l-4 4" />
                                    </svg>
                                  </button>
                                  <div class="z-10 absolute bottom-full left-1/2 transform -translate-x-1/2">
                                    <div class="bg-gray-800 p-2 rounded overflow-hidden mb-2" x-show="open" x-transition:enter="transition ease-out duration-200 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
                                      <div class="text-xs text-gray-200 whitespace-nowrap">Delete Transaction</div>
                                    </div>
                                  </div>
                                </div>
                                <div class="fixed inset-0 bg-gray-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" style="display: none;"></div>

                                <!-- DELETE MODAL -->
                                <div id="danger-modal-delete-<?= $transaction['_id']; ?>" class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center transform px-4 sm:px-6" role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" style="display: none;">
                                  <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                                    <div class="p-5 flex space-x-4">
                                      <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-red-100"><svg class="w-4 h-4 shrink-0 fill-current text-red-500" viewBox="0 0 16 16">
                                          <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"></path>
                                        </svg></div>
                                      <div>
                                        <div class="mb-2">
                                          <div class="text-lg font-semibold text-gray-800">Delete Transaction?</div>
                                        </div>
                                        <div class="text-sm mb-10">
                                          <div class="space-y-2">
                                            <p>Are you sure you want to delete this transaction?</p>
                                          </div>
                                        </div>
                                        <div class="flex flex-wrap justify-end space-x-2">
                                          <button class="btn-sm border-gray-200 hover:border-gray-300 text-gray-600" @click="modalOpen = false">Cancel</button>
                                          <form action="./controllers/transaction.controller.php" method="POST">
                                            <button type="submit" name="delete" value="<?= $transaction['_id']; ?>" class="btn-sm bg-red-500 hover:bg-red-600 text-white">Yes, Delete</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- DELETE MODAL -->
                              </div>
                              <!-- DELETE PART -->

                              <!-- BACK DATE PART -->
                              <div x-data="{ modalOpen: false }">
                                <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                                  <button name="delete" value="<?= $transaction['_id']; ?>" class="btn btn-xs" @click.prevent="modalOpen = true" aria-controls="danger-modal-delete-<?= $transaction['_id']; ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-time" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                                      <circle cx="18" cy="18" r="4" />
                                      <path d="M15 3v4" />
                                      <path d="M7 3v4" />
                                      <path d="M3 11h16" />
                                      <path d="M18 16.496v1.504l1 1" />
                                    </svg>
                                  </button>
                                  <div class="z-10 absolute bottom-full left-1/2 transform -translate-x-1/2">
                                    <div class="bg-gray-800 p-2 rounded overflow-hidden mb-2" x-show="open" x-transition:enter="transition ease-out duration-200 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
                                      <div class="text-xs text-gray-200 whitespace-nowrap">Backdate Transaction</div>
                                    </div>
                                  </div>
                                </div>

                                <div class="fixed inset-0 bg-gray-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" style="display: none;"></div>

                                <!--  BACK DATE MODAL -->
                                <div id="danger-modal-delete-<?= $transaction['_id']; ?>" class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center transform px-4 sm:px-6" role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" style="display: none;">
                                  <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                                    <div class="px-5 py-3 border-b border-gray-200">
                                      <div class="flex justify-between items-center">
                                        <div class="font-semibold text-gray-800">Backdate Transaction</div><button class="text-gray-400 hover:text-gray-500" @click="modalOpen = false">
                                          <div class="sr-only">Close</div><svg class="w-4 h-4 fill-current">
                                            <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z"></path>
                                          </svg>
                                        </button>
                                      </div>
                                    </div>
                                    <div class="px-5 pt-5 pb-1">
                                      <div class="text-sm">
                                        <ul class="space-y-2 mb-4">
                                          <form id="backdate" action="./controllers/transaction.controller.php" method="post">
                                            <div class="mb-4">
                                              <label for="" class="block mb-1 text-sm font-semibold">Transaction ID</label>
                                              <input type="text" value="<?= $transaction["_id"]; ?>" class="form-input text-gray-500 w-full" name="id" required readonly placeholder="Transaction ID" />
                                            </div>

                                            <div class="mb-4">
                                              <label for="" class="block mb-1 text-sm font-semibold">Date </label>
                                              <input type="datetime" class="form-input date-picker w-full" name="date" placeholder="<?= date("d-m-Y H:i:s"); ?>" required />
                                            </div>
                                          </form>
                                        </ul>
                                      </div>
                                    </div>
                                    <div class="px-5 py-4">
                                      <div class="flex flex-wrap justify-end space-x-2">
                                        <button class="btn-sm border-gray-200 hover:border-gray-300 text-gray-600" @click="modalOpen = false">Cancel</button>
                                        <button form="backdate" name="backdate" class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Update</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!--  BACK DATE MODAL -->
                              </div>
                              <!-- BACK DATE PART -->
                            </div>
                          </td>
                          <td></td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else : ?>
                      <tr>
                        <td class="p-2 py-8" colspan="6">
                          <div class="text-left text-center text-gray-400">No Transactions Found</div>
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