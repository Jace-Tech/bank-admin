<section>
  <h3 class="font-semibold text-sm mb-4">Account Information</h3>
  <div class="py-8 px-4 bg-gray-100">
    <div class="flex gap-2 items-center mb-4 border-b border-dashed border-gray-200 pb-2">
      <p class="font-bold text-sm">Name: </p>
      <p class="text-sm flex-1"><?= $USER['user']['name'] ?> </p>
    </div>

    <div class="flex gap-2 items-center mb-4  border-b dashed border-gray-200 pb-2">
      <p class="font-bold text-sm">Email: </p>
      <p class="text-sm flex-1"><?= $USER['user']['email'] ?> </p>
    </div>

    <div class="flex gap-2 items-center mb-4  border-b dashed border-gray-200 pb-2">
      <p class="font-bold text-sm">Gender: </p>
      <p class="text-sm flex-1"><?= $USER['user']['gender'] ?? "<i>NILL</i>" ?> </p>
    </div>

    <div class="flex gap-2 items-center mb-4  border-b dashed border-gray-200 pb-2">
      <p class="font-bold text-sm">Address: </p>
      <p class="text-sm flex-1"><?= $USER['user']['address'] ?? "<i>NILL</i>" ?> </p>
    </div>

    <div class="flex gap-2 items-center mb-4  border-b dashed border-gray-200 pb-2">
      <p class="font-bold text-sm">Password: </p>
      <p class="text-sm flex-1"><?= $USER['user']['password'] ?? "<i>NILL</i>" ?> </p>
    </div>

    <div class="flex gap-2 items-center mb-4  border-b dashed border-gray-200 pb-2">
      <p class="font-bold text-sm">DOB: </p>
      <p class="text-sm flex-1"><?= $USER['user']['dob'] ? date("D d, M Y", strtotime($USER['user']['password']))  : "<i>NILL</i>" ?> </p>
    </div>

    <div class="flex gap-2 items-center mb-4 pb-2">
      <p class="font-bold text-sm">Phone: </p>
      <p class="text-sm flex-1"><?= $USER['user']['phone'] ?? "<i>NILL</i>" ?> </p>
    </div>

    <div class="my-8 border-b border-gray-300"></div>


    <div class="flex gap-2 items-center mb-4  border-b dashed border-gray-200 pb-2">
      <p class="font-bold text-sm">Account Name: </p>
      <p class="text-sm flex-1"><?= $USER['accountName'] ?? "<i>NILL</i>" ?> </p>
    </div>

    <div class="flex gap-2 items-center mb-4  border-b dashed border-gray-200 pb-2">
      <p class="font-bold text-sm">Routing Number: </p>
      <p class="text-sm flex-1"><?= $USER['routingNumber'] ?? "<i>NILL</i>" ?> </p>
    </div>

    <div class="flex gap-2 items-center mb-4  border-b dashed border-gray-200 pb-2">
      <p class="font-bold text-sm">Account Type: </p>
      <p class="text-sm flex-1"><?= $USER['accountType'] ?? "<i>NILL</i>" ?> </p>
    </div>

    <div class="flex gap-2 items-center mb-4  border-b dashed border-gray-200 pb-2">
      <p class="font-bold text-sm">Account Pin: </p>
      <p class="text-sm flex-1"><?= $USER['pin'] ?? "<i>NILL</i>" ?> </p>
    </div>

    <div class="flex gap-2 items-center mb-4  border-b dashed border-gray-200 pb-2">
      <p class="font-bold text-sm">Account Balance: </p>
      <p class="text-sm flex-1"><?= $USER['balance'] ?? "<i>NILL</i>" ?> </p>
    </div>
  </div>
</section>