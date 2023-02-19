<div class="col-span-full">
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
                  <?php if ($loan["user"] && $loan["user"]['_id'] !== $ADMIN["_id"]) : ?>
                    <a href="user-details?user=<?= $loan["user"]['_id'] ?>" class="text-xs text-left text-gray-500 whitespace-nowrap">
                      <?= $loan["user"]["name"] ?? "<i>NILL</i>" ?>
                    </a>
                  <?php else : ?>
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
                  <div class="text-xs text-gray-500 <?= !$loan['interest'] ? "text-center" : "text-left" ?>">
                    <?= $loan['interest'] ? ("$" . $loan["interest"]) : "- - -";  ?>
                  </div>
                </td>

                <td class="p-3">
                  <div class="text-xs text-gray-500 whitespace-nowrap <?= !$loan['endDate'] ? "text-center" : "text-left" ?>">
                    <?= $loan['endDate'] ? date("D d, M Y - H:m A", strtotime($loan["endDate"])) : "- - -";  ?>
                  </div>
                </td>

                <td class="p-3">
                  <div class="flex gap-2">
                    <!-- DELETE PART -->
                    <?php include("./components/loanDelete.php"); ?>
                    <!-- DELETE PART -->

                    <?php if ($loan['status'] == "pending") : ?>
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