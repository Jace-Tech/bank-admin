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