<?php include("./config/index.php") ?>
<?php include("./middleware/auth.middleware.php") ?>
<?php include("./inc/banks.php") ?>
<?php if (!isset($_GET['user'])) header("Location: ./users"); ?>

<?php
$ALLOWED_LIST = getAllUserAllowedList($TOKEN, $_GET['user']);
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Dashboard - Allowed List</title>
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
          <div class="sm:flex sm:justify-between sm:items-center mb-8">
            <div class="mb-4 sm:mb-0">
              <h1 class="text-2xl md:text-3xl text-gray-800 font-bold">Allowed List</h1>
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
            <header class="px-5 flex items-center justify-between py-4 border-b border-gray-100">
              <h2 class="font-semibold text-gray-800">Allowed records</h2>
              <div x-data="{ modalOpen: false }">
                <button class="btn btn-sm bg-indigo-500 hover:bg-indigo-600 text-white" @click.prevent="modalOpen = true" aria-controls="plan-modal">Add new record</button>

                <!-- CREATE MODAL -->
                <div class="fixed inset-0 bg-gray-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true"></div>
                <div id="plan-modal" class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center transform px-4 sm:px-6" role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4">
                  <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                    <div class="px-5 py-3 border-b border-gray-200">
                      <div class="flex justify-between items-center">
                        <div class="font-semibold text-gray-800">Create new record</div><button class="text-gray-400 hover:text-gray-500" @click="modalOpen = false">
                          <div class="sr-only">Close</div><svg class="w-4 h-4 fill-current">
                            <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z"></path>
                          </svg>
                        </button>
                      </div>
                    </div>
                    <div class="px-5 pt-5 pb-1">
                      <div class="text-sm">
                        <ul class="space-y-2 mb-4">
                          <form id="allowed" action="./controllers/allowed.controller.php" method="post">
                            <div class="mb-4">
                              <label for="" class="block mb-1 text-sm font-semibold">Account Number</label>
                              <input type="hidden" name="user" value="<?= $_GET['user']; ?>">
                              <input type="text" class="form-input w-full" name="accountNumber" placeholder="Account Number" />
                            </div>

                            <div class="mb-4">
                              <label for="" class="block mb-1 text-sm font-semibold">Bank Name</label>
                              <input type="text" class="form-input w-full" name="bank" placeholder="Bank Name" list="banks" />
                              <datalist id="banks">
                                <?php foreach ($banks as $bank) : ?>
                                  <option value="<?= $bank ?>"></option>
                                <?php endforeach; ?>
                              </datalist>
                            </div>
                          </form>
                        </ul>
                      </div>
                    </div>
                    <div class="px-5 py-4">
                      <div class="flex flex-wrap justify-end space-x-2">
                        <button class="btn-sm border-gray-200 hover:border-gray-300 text-gray-600" @click="modalOpen = false">Cancel</button>
                        <button form="allowed" name="create" class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Create</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- CREATE MODAL -->

              </div>
            </header>
            <div class="p-3">
              <div class="overflow-x-auto">
                <table class="table-auto w-full">
                  <thead class="text-xs uppercase text-gray-400 bg-gray-50 rounded-sm">
                    <tr>
                      <th class="p-2">
                        <div class="font-semibold text-left">S/N</div>
                      </th>

                      <th class="p-2">
                        <div class="font-semibold text-left">Bank Name</div>
                      </th>

                      <th class="p-2">
                        <div class="font-semibold text-left">Bank Account</div>
                      </th>
                      <th class="p-2">
                        <div class="font-semibold text-left"></div>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="text-sm font-medium divide-y divide-gray-100">
                    <?php if (count($ALLOWED_LIST)) : ?>
                      <?php for ($i = 0; $i < count($ALLOWED_LIST); $i++) : ?>
                        <tr>
                          <td class="p-3">
                            <div class="text-sm text-gray-500"><?= $i + 1; ?></div>
                          </td>
                          <td class="p-3">
                            <div class="text-sm text-gray-500"><?= $ALLOWED_LIST[$i]['bank'] ?></div>
                          </td>
                          <td class="p-3">
                            <div class="text-sm text-gray-500"><?= $ALLOWED_LIST[$i]['accountNumber'] ?></div>
                          </td>
                          <td class="p-3">
                            <div class="flex-gap-3">
                              <div x-data="{ modalOpen: false }">
                                <button name="delete" value="<?= $ALLOWED_LIST[$i]['_id']; ?>" class="btn btn-xs" @click.prevent="modalOpen = true" aria-controls="danger-modal-<?= $ALLOWED_LIST[$i]['_id']; ?>">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff2825" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7h16" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    <path d="M10 12l4 4m0 -4l-4 4" />
                                  </svg>
                                </button>
                                <div class="fixed inset-0 bg-gray-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" style="display: none;"></div>

                                <!-- DELETE MODAL -->
                                <div id="danger-modal-<?= $ALLOWED_LIST[$i]['_id']; ?>" class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center transform px-4 sm:px-6" role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" style="display: none;">
                                  <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                                    <div class="p-5 flex space-x-4">
                                      <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-red-100"><svg class="w-4 h-4 shrink-0 fill-current text-red-500" viewBox="0 0 16 16">
                                          <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"></path>
                                        </svg></div>
                                      <div>
                                        <div class="mb-2">
                                          <div class="text-lg font-semibold text-gray-800">Delete Record?</div>
                                        </div>
                                        <div class="text-sm mb-10">
                                          <div class="space-y-2">
                                            <p>Are you sure you want to delete this record?</p>
                                          </div>
                                        </div>
                                        <div class="flex flex-wrap justify-end space-x-2">
                                          <button class="btn-sm border-gray-200 hover:border-gray-300 text-gray-600" @click="modalOpen = false">Cancel</button>
                                          <form action="./controllers/allowed.controller.php" method="POST">
                                            <input type="hidden" name="user" value="<?= $_GET['user']; ?>">
                                            <button type="submit" name="delete" value="<?= $ALLOWED_LIST[$i]['_id']; ?>" class="btn-sm bg-red-500 hover:bg-red-600 text-white">Yes, Delete</button>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- DELETE MODAL -->
                              </div>
                            </div>
                          </td>
                        </tr>
                      <?php endfor; ?>
                    <?php else : ?>
                      <tr>
                        <td class="p-2 py-8" colspan="6">
                          <div class="text-center text-gray-400">No Record Found</div>
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
</body>

</html>