<div class="col-span-full">
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
                  <?php if ($transaction["sender"] && $transaction["sender"]['_id'] !== $ADMIN["_id"]) : ?>
                    <a href="user-details?user=<?= $transaction["sender"]['_id'] ?>" class="text-xs text-left text-gray-500 whitespace-nowrap">
                      <?= $transaction["sender"]["accountName"] ?? "<i>NILL</i>" ?>
                    </a>
                  <?php else : ?>
                    <div class="text-xs text-left text-gray-500 whitespace-nowrap">
                      <?= $transaction["sender"]["accountName"] ?? "<i>NILL</i>" ?>
                    </div>
                  <?php endif; ?>
                </td>
                <td class="p-3">
                  <div class="text-xs text-left text-gray-500 whitespace-nowrap">
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
                    <?php include("./components/transactionDelete.php") ?>
                    <!-- DELETE PART -->

                    <!-- BACK DATE PART -->
                    <?php include("./components/transactionApprove.php"); ?>
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