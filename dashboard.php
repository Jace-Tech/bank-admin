<?php include("./addons/Session.php") ?>
<?php include("./middleware/auth.middleware.php") ?>

<?php 
    $USERS = getAllUsers($TOKEN);
    $ALL_TRANSACTIONS = getAllTransactions($TOKEN);
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

<body class="font-inter antialiased bg-gray-100 text-gray-600" :class="{ 'sidebar-expanded': sidebarExpanded }"
    x-data="{ page: 'dashboard', sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }"
    x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">
    <script>localStorage.setItem('sidebar-expanded', 'true')</script>
    <script>if (localStorage.getItem('sidebar-expanded') == 'true') {
            document.querySelector('body').classList.add('sidebar-expanded');
        } else {
            document.querySelector('body').classList.remove('sidebar-expanded');
        }</script>
    <div class="flex h-screen overflow-hidden">
       <?php include("./inc/Sidebar.php") ?>
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden">
            <?php include("./inc/Header.php"); ?>
            <main>
                <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
                    <div class="relative bg-indigo-200 p-4 sm:p-6 rounded-sm overflow-hidden mb-8">
                        <div class="absolute right-0 top-0 -mt-4 mr-16 pointer-events-none hidden xl:block"
                            aria-hidden="true"><svg width="319" height="198" xmlns:xlink="http://www.w3.org/1999/xlink">
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
                                        <path fill="url(#welcome-c)" mask="url(#welcome-f)"
                                            d="M40.333-15.147h50v95h-50z" />
                                    </g>
                                    <g transform="rotate(44 61.546 392.623)">
                                        <mask id="welcome-h" fill="#fff">
                                            <use xlink:href="#welcome-g" />
                                        </mask>
                                        <use fill="url(#welcome-b)" xlink:href="#welcome-g" />
                                        <path fill="url(#welcome-c)" mask="url(#welcome-h)"
                                            d="M40.333-15.147h50v95h-50z" />
                                    </g>
                                </g>
                            </svg></div>
                        <div class="relative">
                            <h1 class="text-2xl md:text-3xl text-gray-800 font-bold mb-1">Good <?= getGreeting(); ?>, <?= $ADMIN['name'] ?>. 👋
                            </h1>
                        </div>
                    </div>
                    <div class="grid grid-cols-12 gap-6">
                        <div
                            class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-gray-200">
                            <div class="px-5 pt-5">
                                
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">Users</h2>
                                <div class="flex items-start">
                                    <div class="h1 font-bold text-gray-500 pb-6 mr-2">
                                        <?= count($USERS); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div
                            class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-gray-200">
                            <div class="px-5 pt-5">
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">Pending Transactions</h2>
                                <div class="flex items-start">
                                    <div class="h1 font-bold text-gray-500 pb-6 mr-2">
                                        <?= count($PENDING_TRANSACTIONS); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex flex-col col-span-full sm:col-span-6 xl:col-span-4 bg-white shadow-lg rounded-sm border border-gray-200">
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
                            <header class="px-5 py-4 border-b border-gray-100">
                                <h2 class="font-semibold text-gray-800">Latest Transactions</h2>
                            </header>
                            <div class="p-3">
                                <div class="overflow-x-auto">
                                    <table class="table-auto w-full">
                                        <thead class="text-xs uppercase text-gray-400 bg-gray-50 rounded-sm">
                                            <tr>
                                                <th class="p-2">
                                                    <div class="font-semibold text-left">Sender</div>
                                                </th>
                                                <th class="p-2">
                                                    <div class="font-semibold text-center">Recipient</div>
                                                </th>
                                                <th class="p-2">
                                                    <div class="font-semibold text-center">Amount</div>
                                                </th>
                                                <th class="p-2">
                                                    <div class="font-semibold text-center">Status</div>
                                                </th>
                                                <th class="p-2">
                                                    <div class="font-semibold text-center">Token</div>
                                                </th>
                                                <th class="p-2">
                                                    <div class="font-semibold text-center"></div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm font-medium divide-y divide-gray-100">
                                            <?php if(count($ALL_TRANSACTIONS)): ?>
                                                <?php foreach($ALL_TRANSACTIONS as $transaction): ?>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td class="p-2 py-8" colspan="6">
                                                        <div class="text-center text-gray-400">No Transactions Found</div>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                            <!-- <tr>
                                                <td class="p-2">
                                                    <div class="flex items-center"><svg class="shrink-0 mr-2 sm:mr-3"
                                                            width="36" height="36" viewBox="0 0 36 36">
                                                            <circle fill="#24292E" cx="18" cy="18" r="18" />
                                                            <path
                                                                d="M18 10.2c-4.4 0-8 3.6-8 8 0 3.5 2.3 6.5 5.5 7.6.4.1.5-.2.5-.4V24c-2.2.5-2.7-1-2.7-1-.4-.9-.9-1.2-.9-1.2-.7-.5.1-.5.1-.5.8.1 1.2.8 1.2.8.7 1.3 1.9.9 2.3.7.1-.5.3-.9.5-1.1-1.8-.2-3.6-.9-3.6-4 0-.9.3-1.6.8-2.1-.1-.2-.4-1 .1-2.1 0 0 .7-.2 2.2.8.6-.2 1.3-.3 2-.3s1.4.1 2 .3c1.5-1 2.2-.8 2.2-.8.4 1.1.2 1.9.1 2.1.5.6.8 1.3.8 2.1 0 3.1-1.9 3.7-3.7 3.9.3.4.6.9.6 1.6v2.2c0 .2.1.5.6.4 3.2-1.1 5.5-4.1 5.5-7.6-.1-4.4-3.7-8-8.1-8z"
                                                                fill="#FFF" />
                                                        </svg>
                                                        <div class="text-gray-800">Github.com</div>
                                                    </div>
                                                </td>
                                                <td class="p-2">
                                                    <div class="text-center">2.4K</div>
                                                </td>
                                                <td class="p-2">
                                                    <div class="text-center text-green-500">$3,877</div>
                                                </td>
                                                <td class="p-2">
                                                    <div class="text-center">267</div>
                                                </td>
                                                <td class="p-2">
                                                    <div class="text-center text-light-blue-500">4.7%</div>
                                                </td>
                                            </tr> -->
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