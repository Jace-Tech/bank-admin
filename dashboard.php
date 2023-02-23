<?php $LINK = "dashboard"; ?>
<?php include("./config/index.php") ?>
<?php include("./middleware/auth.middleware.php") ?>

<?php
$USERS = getAllUsers($TOKEN);
$ALL_TRANSACTIONS = getAllTransactions($TOKEN);
$ALL_TRANSACTIONS = array_slice($ALL_TRANSACTIONS, 0, 10);
$PENDING_TRANSACTIONS = getAllPendingTransactions($TOKEN);
$APPROVED_TRANSACTIONS = getAllApprovedTransactions($TOKEN);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mosaic HTML Demo - Home</title>
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
                    <div class="relative bg-indigo-200 p-4 sm:p-6 rounded-sm overflow-hidden mb-8">
                        <div class="absolute right-0 top-0 -mt-4 mr-16 pointer-events-none hidden xl:block" aria-hidden="true"><svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs>
                                    <path id="welcome-a" d="M64 0l64 128-64-20-64 20z" />
                                    <path id="welcome-e" d="M40 0l40 80-40-12.5L0 80z" />
                                    <path id="welcome-g" d="M40 0l40 80-40-12.5L0 80z" />
                                    <linearGradient x1="50%" y1="0%" x2="50%" y2="100%" id="welcome-b">
                                        <stop stop-color="#A5B4FC" offset="0%" />
                                        <stop stop-color="#818CF8" offset="100%" />
                                    </linearGradient>
                                    <linearGradient x1="50%" y1="24.537%" x2="50%" y2="100%" id="welcome-c">
                                        <stop stop-color="#4338CA" offset="0%" />
                                        <stop stop-color="#6366F1" stop-opacity="0" offset="100%" />
                                    </linearGradient>
                                </defs>
                                <g fill="none" fill-rule="evenodd">
                                    <g transform="rotate(64 36.592 105.604)">
                                        <mask id="welcome-d" fill="#fff">
                                            <use xlink:href="#welcome-a" />
                                        </mask>
                                        <use fill="url(#welcome-b)" xlink:href="#welcome-a" />
                                        <path fill="url(#welcome-c)" mask="url(#welcome-d)" d="M64-24h80v152H64z" />
                                    </g>
                                    <g transform="rotate(-51 91.324 -105.372)">
                                        <mask id="welcome-f" fill="#fff">
                                            <use xlink:href="#welcome-e" />
                                        </mask>
                                        <use fill="url(#welcome-b)" xlink:href="#welcome-e" />
                                        <path fill="url(#welcome-c)" mask="url(#welcome-f)" d="M40.333-15.147h50v95h-50z" />
                                    </g>
                                    <g transform="rotate(44 61.546 392.623)">
                                        <mask id="welcome-h" fill="#fff">
                                            <use xlink:href="#welcome-g" />
                                        </mask>
                                        <use fill="url(#welcome-b)" xlink:href="#welcome-g" />
                                        <path fill="url(#welcome-c)" mask="url(#welcome-h)" d="M40.333-15.147h50v95h-50z" />
                                    </g>
                                </g>
                            </svg></div>
                        <div class="relative">
                            <h1 class="text-2xl md:text-3xl text-gray-800 font-bold mb-1">Good <?= getGreeting(); ?>, <?= $ADMIN['name'] ?>. 👋
                            </h1>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-6">
                        <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-gray-200">
                            <div class="px-5 pt-5">

                                <h2 class="text-lg font-semibold text-gray-800 mb-2">Users</h2>
                                <div class="flex items-start">
                                    <div class="h1 font-bold text-gray-500 pb-6 mr-2">
                                        <?= count($USERS); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-gray-200">
                            <div class="px-5 pt-5">
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">Pending Transactions</h2>
                                <div class="flex items-start">
                                    <div class="h1 font-bold text-gray-500 pb-6 mr-2">
                                        <?= count($PENDING_TRANSACTIONS); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-gray-200">
                            <div class="px-5 pt-5">
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">Approved Transactions</h2>
                                <div class="flex items-start">
                                    <div class="h1 font-bold text-gray-500 pb-6 mr-2">
                                        <?= count($APPROVED_TRANSACTIONS); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-full bg-white shadow-lg rounded-sm border border-gray-200">
                            <header class="px-5 flex items-center justify-between py-4 border-b border-gray-100">
                                <h2 class="font-semibold text-gray-800">Latest Transactions</h2>
                                <a href="./all-transactions" class="text-sm text-indigo-500">View more</a>
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
                </div>
            </main>
        </div>
    </div>
    <script src="./assets/main.75545896273710c7378c.js"></script>
</body>

</html>