<select class="form-control" id="ItemAuction" name="ItemAuction">
  <option>Auction1</option>
  <option>Auction2</option>
  <option>Auction3</option>
</select>
  <input type="text" class="form-control" id="ItemTitle" name="ItemTitle" placeholder="My Item" required>
  <textarea class="form-control" id="ItemDescription"  name="ItemDescription" rows="3" required></textarea>
    <input type="number" class="form-control" id="ItemStartingBid" name="ItemStartingBid" placeholder="0.00" step="0.01" min="0" required>
    <input type="number" class="form-control" id="ItemMinIncrement" name="ItemMinIncrement" placeholder="0.00" step="0.01" min="0" required>
  <select class="form-control" id="ItemDonor" name="ItemDonor" required>
    <option>Anonymous</option>
    <option>Donor1</option>
    <option>Donor2</option>
    <option>Donor3</option>
  </select>

    <input type="file" class="custom-file-input" id="ItemPicture" name="ItemPicture" onchange="changeLabel( this )" required>
<?php


?>
