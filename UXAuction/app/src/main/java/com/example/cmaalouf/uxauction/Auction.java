package com.example.cmaalouf.uxauction;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

public class Auction
{
    private List<Item> itemsInAuction;
    /*
    In order to keep track of how much each donor makes at the end of the auction,
    as well as how much total money was raised, the auction needs to keep track of each donor
    and what items they donated. To do this, the auction holds a map of donors associated
    with the items they donated.
     */
    private HashMap<Donor, Set<Item>> donorsOfItems;
    private int startTime;
    private int endTime;
    private Charity beneficiary;


    public Auction(int startTime, int endTime, Charity beneficiary)
    {
        this.startTime = startTime;
        this.endTime = endTime;
        this.beneficiary = beneficiary;
        itemsInAuction = new ArrayList<>();
        donorsOfItems = new HashMap<>();

    }

    /**
     * Purpose: Add an item to the auction
     * @param itemToAdd the item to add
     * @param donor the donor of the item to add
     */
    public void addItem(Item itemToAdd, Donor donor)
    {
        //Update the map of donors associated with items
        Set<Item> itemsDonatedByThisDonor = donor.getItemsDonated();
        if(itemsDonatedByThisDonor == null)
        {
            itemsDonatedByThisDonor = new HashSet<>();
            donorsOfItems.put(donor, itemsDonatedByThisDonor);
        }

        itemsDonatedByThisDonor.add(itemToAdd);
        donorsOfItems.put(donor, itemsDonatedByThisDonor);

        //add to the list of items in the auction
        itemsInAuction.add(itemToAdd);

    }

    /**
     * Purpose: Remove an item from the auction
     * @param itemToDelete the item to delete
     * @param donor the donor of the deleted item
     */
    public void deleteItem(Item itemToDelete, Donor donor)
    {
        //update the map of donors associated with items
        Set<Item> itemsDonatedByThisDonor = donor.getItemsDonated();

        if(itemsDonatedByThisDonor != null)
        {
            donorsOfItems.remove(donor, itemsDonatedByThisDonor);
        }

        //update the list of items in the auction
        itemsInAuction.remove(itemToDelete);
    }

    /**
     * Purpose: Give other classes, namely the system, access to an auctions list of items
     * @return the list of items in the auction
     */
    public List<Item> getItemsInAuction()
    {
        return this.itemsInAuction;
    }

    /**
     * Purpose: Give other classes access to the map of donors associated with their items
     * @return the map of donors associated with their items
     */
    public HashMap<Donor, Set<Item>> getDonorsOfItems()
    {
        return this.donorsOfItems;
    }

    //TO DO, not sure what this would like
    //public void editItem(){}

    //TO DO, not sure what this would like
//    public Item searchItem()
//    {
//
//    }

    //NEEDS TO BE CHANGED PROBABLY
    public void setTimeLeft(int timeLeft)
    {
        System.out.println("Countdown: " + timeLeft);
    }

    //notifyBidderOutBid and notfiyBidderWinner require the ability to use java to send emails
}
