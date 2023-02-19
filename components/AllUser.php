<div class="grid grid-cols-12 gap-6">
  <?php if (count($ALL_ACCOUNTS)) : ?>
    <?php foreach ($ALL_ACCOUNTS as $account) : ?>
      <div class="col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-gray-200">
        <div class="flex flex-col h-full">
          <div class="grow p-5">
            <div class="flex justify-between items-start">
              <header>
                <div class="flex mb-2">
                  <a class="relative inline-flex items-start mr-5" href="./user-details?user=<?= $account['user']['_id'] ?>">
                    <?php if (!$account['user']['isActive']) : ?>
                      <div class="absolute top-0 right-0 -mr-2 bg-red-500 p-1 rounded-full shadow" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-off" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M14.274 10.291a4 4 0 1 0 -5.554 -5.58m-.548 3.453a4.01 4.01 0 0 0 2.62 2.65" />
                          <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 1.147 .167m2.685 2.681a4 4 0 0 1 .168 1.152v2" />
                          <line x1="3" y1="3" x2="21" y2="21" />
                        </svg>
                      </div>
                    <?php endif; ?>
                    <?php if($account['user']['image']): ?>
                      <img class="rounded-full" src="<?= $account['user']['image'] ?>" width="64" height="64" alt="User 01" />
                    <?php else: ?>
                      <img class="rounded-full" src="./assets/images/user-avatar-80.png" width="64" height="64" alt="User 01" />
                    <?php endif; ?>
                  </a>
                  <div class="mt-1 pr-1">
                    <a class="inline-flex text-indigo-500 hover:text-indigo-900" href="./user-details?user=<?= $account['user']['_id'] ?>">
                      <h2 class="text-xl leading-snug justify-center font-semibold"><?= $account["user"]["name"] ?></h2>
                    </a>
                    <p style="letter-spacing: 1px;" class="mt-1 text-gray-400 text-sm"><?= $account['accountNumber'] ?></p>
                  </div>
                </div>
              </header>
              <div class="relative inline-flex shrink-0" x-data="{ open: false }"><button class="text-gray-400 hover:text-gray-500 rounded-full" :class="{ 'bg-gray-100 text-gray-500': open }" aria-haspopup="true" @click.prevent="open = !open" :aria-expanded="open"><span class="sr-only">Menu</span> <svg class="w-8 h-8 fill-current" viewBox="0 0 32 32">
                    <circle cx="16" cy="16" r="2" />
                    <circle cx="10" cy="16" r="2" />
                    <circle cx="22" cy="16" r="2" />
                  </svg></button>
                <div class="origin-top-right z-10 absolute top-full right-0 min-w-36 bg-white border border-gray-200 py-1.5 rounded shadow-lg overflow-hidden mt-1" @click.outside="open = false" @keydown.escape.window="open = false" x-show="open" x-transition:enter="transition ease-out duration-200 transform" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>
                  <ul>
                    <li>
                      <!-- <a class="font-medium text-sm text-gray-600 hover:text-gray-800 flex py-1 px-3" href="#0" @click="open = false" @focus="open = true" @focusout="open = false">Option 1</a></li> -->
                      <a class="font-medium text-sm text-gray-600 hover:text-gray-800 flex py-1 px-3" href="./allowed-list?user=<?= $account['user']['_id'] ?>" @click="open = false" @focus="open = true" @focusout="open = false">Allowed List</a>
                    <li>
                      
                    <li x-data="{ modalOpen: false }">
                    <a class="font-medium text-sm text-red-500 hover:text-red-600 flex py-1 px-3" href="#"  @click.prevent="modalOpen = true" aria-controls="danger-modal-<?=  $account['user']['_id']; ?>">Remove</a>
                      <div class="fixed inset-0 bg-gray-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" style="display: none;"></div>
                      
                      <!-- DELETE MODAL -->
                      <div id="danger-modal-<?=  $account['user']['_id']; ?>" class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center transform px-4 sm:px-6" role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" style="display: none;">
                        <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                          <div class="p-5 flex space-x-4">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-red-100"><svg class="w-4 h-4 shrink-0 fill-current text-red-500" viewBox="0 0 16 16">
                                <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"></path>
                              </svg></div>
                            <div>
                              <div class="mb-2">
                                <div class="text-lg font-semibold text-gray-800">Delete User?</div>
                              </div>
                              <div class="text-sm mb-10">
                                <div class="space-y-2">
                                  <p>Are you sure you want to delete this user?</p>
                                </div>
                              </div>
                              <div class="flex flex-wrap justify-end space-x-2">
                                <button class="btn-sm border-gray-200 hover:border-gray-300 text-gray-600" @click="modalOpen = false">Cancel</button> 
                                <form action="./controllers/user.controller.php">
                                  <button type="submit" name="delete" value="<?= $account["user"]['_id']; ?>" class="btn-sm bg-red-500 hover:bg-red-600 text-white">Yes, Delete</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- DELETE MODAL -->
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="mt-2">
              <h3 class="text-gray-600 text-sm font-semibold mb-2"><?= $account["accountType"]; ?></h3>
              <div class="flex items-center gap-2">
                <span class="text-xs font-medium text-gray-500 uppercase">Balance: </span>
                <div class="text-md font-bold ">$ <?= $account["balance"]; ?></div>
              </div>
            </div>
          </div>
          <div class="border-t border-gray-200">
            <div class="flex divide-x divide-gray-200r">
              <div class="flex-1 flex items-center justify-center" x-data="{ modalOpen: false }">
                <button class="block flex-1 text-center text-sm text-indigo-500 hover:text-indigo-600 font-medium px-3 py-4" @click.prevent="modalOpen = true" aria-controls="basic-modal-<?= $account['user']['_id']; ?>">
                  <div class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-cash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#6366f1" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <rect x="7" y="9" width="14" height="10" rx="2" />
                      <circle cx="14" cy="14" r="2" />
                      <path d="M17 9v-2a2 2 0 0 0 -2 -2h-10a2 2 0 0 0 -2 2v6a2 2 0 0 0 2 2h2" />
                    </svg>
                    <span class="ml-2">Credit User</span>
                  </div>
                </button>

                <!-- CREDIT MODAL  -->
                <div class="fixed inset-0 bg-gray-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true"></div>
                <div id="basic-modal-<?= $account['user']['_id']; ?>" class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center transform px-4 sm:px-6" role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4">
                  <div class="bg-white rounded shadow-lg overflow-auto max-w-sm w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
                    <div class="px-5 py-3 border-b border-gray-200">
                      <div class="flex justify-between items-center">
                        <div class="font-semibold text-gray-800">Credit Account</div>
                        <button class="text-gray-400 hover:text-gray-500" @click="modalOpen = false">
                          <div class="sr-only">Close</div><svg class="w-4 h-4 fill-current">
                            <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z"></path>
                          </svg>
                        </button>
                      </div>
                    </div>
                    <div class="px-5 pt-4 pb-1">
                      <form id="credit-<?= $account["user"]["_id"]; ?>" action="./controllers/account.controller.php" method="post">
                        <div class="mb-3">
                          <label for="" class="block mb-1 text-sm font-semibold">Account</label>
                          <input type="text" name="account" readonly class="form-input w-full text-gray-500" value="<?= $account['accountNumber'] ?>">
                          <input type="hidden" name="user" value="<?= $account['user']['_id']; ?>">
                        </div>

                        <div class="mb-3">
                          <label for="" class="block mb-1 text-sm font-semibold">Amount</label>
                          <input type="number" name="amount" class="form-input w-full" placeholder="100">
                        </div>
                      </form>
                    </div>
                    <div class="px-5 py-4">
                      <div class="flex flex-wrap justify-end space-x-2">
                        <button class="btn-sm border-gray-200 hover:border-gray-300 text-gray-600" @click="modalOpen = false">Close</button>
                        <button formaction="./controllers/account.controller.php" form="credit-<?= $account["user"]["_id"]; ?>" name="credit" class="btn-sm bg-indigo-500 hover:bg-indigo-600 text-white">Credit</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- CREDIT MODAL  -->
              </div>

              <?php if ($account['user']['isActive']) : ?>
                <a class="block flex-1 text-center text-sm text-red-600 hover:text-red-800 font-medium px-3 py-4 group" href="./controllers/user.controller?block=<?= $account['user']['_id']; ?>">
                  <div class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-off" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#fd0061" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <path d="M20.042 16.045a9 9 0 0 0 -12.087 -12.087m-2.318 1.677a9 9 0 1 0 12.725 12.73" />
                      <path d="M3 3l18 18" />
                    </svg>
                    <span class="ml-2">Block User</span>
                  </div>
                </a>
              <?php else : ?>
                <a class="block flex-1 text-center text-sm text-green-600 hover:text-green-800 font-medium px-3 py-4 group" href="./controllers/user.controller?unblock=<?= $account['user']['_id']; ?>">
                  <div class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-minus" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#16a34a" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                      <circle cx="12" cy="12" r="9" />
                      <line x1="9" y1="12" x2="15" y2="12" />
                    </svg>
                    <span class="ml-2">Unblock User</span>
                  </div>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else : ?>
   <div class="col-span-full">
    <p class="mt-5 text-gray-500">No user found</p>
   </div>
  <?php endif; ?>
</div>

<?php if (count($ALL_ACCOUNTS) > 12) : ?>
  <div class="mt-8">
    <div class="flex justify-center">
      <nav class="flex" role="navigation" aria-label="Navigation">
        <div class="mr-2"><span class="inline-flex items-center justify-center rounded leading-5 px-2.5 py-2 bg-white border border-gray-200 text-gray-300"><span class="sr-only">Previous</span><wbr /> <svg class="h-4 w-4 fill-current" viewBox="0 0 16 16">
              <path d="M9.4 13.4l1.4-1.4-4-4 4-4-1.4-1.4L4 8z" />
            </svg></span></div>
        <ul class="inline-flex text-sm font-medium -space-x-px shadow-sm">
          <li><span class="inline-flex items-center justify-center rounded-l leading-5 px-3.5 py-2 bg-white border border-gray-200 text-indigo-500">1</span>
          </li>
          <li><a class="inline-flex items-center justify-center leading-5 px-3.5 py-2 bg-white hover:bg-indigo-500 border border-gray-200 text-gray-600 hover:text-white" href="#0">2</a></li>
          <li><a class="inline-flex items-center justify-center leading-5 px-3.5 py-2 bg-white hover:bg-indigo-500 border border-gray-200 text-gray-600 hover:text-white" href="#0">3</a></li>
          <li><span class="inline-flex items-center justify-center leading-5 px-3.5 py-2 bg-white border border-gray-200 text-gray-400">…</span>
          </li>
          <li><a class="inline-flex items-center justify-center rounded-r leading-5 px-3.5 py-2 bg-white hover:bg-indigo-500 border border-gray-200 text-gray-600 hover:text-white" href="#0">9</a></li>
        </ul>
        <div class="ml-2"><a href="#0" class="inline-flex items-center justify-center rounded leading-5 px-2.5 py-2 bg-white hover:bg-indigo-500 border border-gray-200 text-gray-600 hover:text-white shadow-sm"><span class="sr-only">Next</span><wbr /> <svg class="h-4 w-4 fill-current" viewBox="0 0 16 16">
              <path d="M6.6 13.4L5.2 12l4-4-4-4 1.4-1.4L12 8z" />
            </svg></a></div>
      </nav>
    </div>
  </div>
<?php endif; ?>