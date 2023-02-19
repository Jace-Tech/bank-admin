<div x-data="{ modalOpen: false }">
  <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
    <button name="delete" value="<?= $loan['_id']; ?>" class="btn btn-xs" @click.prevent="modalOpen = true" aria-controls="danger-modal-cancel-<?= $loan['_id']; ?>">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ff9300" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <line x1="18" y1="6" x2="6" y2="18" />
        <line x1="6" y1="6" x2="18" y2="18" />
      </svg>
    </button>
    <div class="z-10 absolute bottom-full left-1/2 transform -translate-x-1/2">
      <div class="bg-gray-800 p-2 rounded overflow-hidden mb-2" x-show="open" x-transition:enter="transition ease-out duration-200 transform" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-out duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
        <div class="text-xs text-gray-200 whitespace-nowrap">Cancel loan</div>
      </div>
    </div>
  </div>

  <div class="fixed inset-0 bg-gray-900 bg-opacity-30 z-50 transition-opacity" x-show="modalOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-out duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" aria-hidden="true" style="display: none;"></div>

  <!-- CANCEL MODAL -->
  <div id="danger-modal-cancel-<?= $loan['_id']; ?>" class="fixed inset-0 z-50 overflow-hidden flex items-center my-4 justify-center transform px-4 sm:px-6" role="dialog" aria-modal="true" x-show="modalOpen" x-transition:enter="transition ease-in-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in-out duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4" style="display: none;">
    <div class="bg-white rounded shadow-lg overflow-auto max-w-lg w-full max-h-full" @click.outside="modalOpen = false" @keydown.escape.window="modalOpen = false">
      <div class="p-5 flex space-x-4">
        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 bg-yellow-100"><svg class="w-4 h-4 shrink-0 fill-current text-yellow-600" viewBox="0 0 16 16">
            <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"></path>
          </svg></div>
        <div>
          <div class="mb-2">
            <div class="text-lg font-semibold text-gray-800">Cancel loan?</div>
          </div>
          <div class="text-sm mb-10">
            <div class="space-y-2">
              <p>Are you sure you want to cancel this loan?</p>
            </div>
          </div>
          <div class="flex flex-wrap justify-end space-x-2">
            <button class="btn-sm border-gray-200 hover:border-gray-300 text-gray-600" @click="modalOpen = false">Close</button>
            <form action="./controllers/loan.controller.php" method="POST">
              <button type="submit" name="cancel" value="<?= $loan['_id']; ?>" class="btn-sm bg-yellow-500 hover:bg-yellow-600 text-white">Yes, Cancel</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CANCEL MODAL -->
</div>