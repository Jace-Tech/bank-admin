<?php 
  if (isset($_SESSION['ADMIN_ALERT'])) { $ALERT = json_decode($_SESSION['ADMIN_ALERT'], true); 
  $colorMap = [
    "success" => "green",
    "error" => "red",
    "warning" => "yellow",
    "info" => "blue",
  ];
?>
  <div style="position: fixed; top: 1rem; right: 2rem; z-index: 99999; display: flex; flex-direction: column; gap: .5rem;">
    <div x-show="open" x-data="{ open: true }">
      <div class="inline-flex min-w-80 px-4 py-2 rounded-sm text-sm bg-<?= $colorMap[$ALERT['type']]; ?>-100 border border-<?= $colorMap[$ALERT['type']]; ?>-200 text-<?= $colorMap[$ALERT['type']]; ?>-600">
        <div class="flex w-full justify-between items-start">
          <div class="flex"><svg class="w-4 h-4 shrink-0 fill-current opacity-80 mt-[3px] mr-3" viewBox="0 0 16 16">
              <path d="M8 0C3.6 0 0 3.6 0 8s3.6 8 8 8 8-3.6 8-8-3.6-8-8-8zm0 12c-.6 0-1-.4-1-1s.4-1 1-1 1 .4 1 1-.4 1-1 1zm1-3H7V4h2v5z"></path>
            </svg>
            <div><?= $ALERT["message"] ?></div>
          </div><button class="opacity-70 hover:opacity-80 ml-3 mt-[3px]" @click="open = false">
            <div class="sr-only">Close</div><svg class="w-4 h-4 fill-current">
              <path d="M7.95 6.536l4.242-4.243a1 1 0 111.415 1.414L9.364 7.95l4.243 4.242a1 1 0 11-1.415 1.415L7.95 9.364l-4.243 4.243a1 1 0 01-1.414-1.415L6.536 7.95 2.293 3.707a1 1 0 011.414-1.414L7.95 6.536z"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>
<?php unset($_SESSION['ADMIN_ALERT']);}?>