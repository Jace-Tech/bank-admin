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