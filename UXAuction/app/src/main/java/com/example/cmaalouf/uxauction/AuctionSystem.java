package com.example.cmaalouf.uxauction;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Set;
import java.util.TreeMap;

public class AuctionSystem
{
    ArrayList<Bidder> listOfAllBidders;
    ArrayList<Bidder> biddersInAuction;

    /**
     * Purpose: Print the amount raised by each donor, the total amount raised by the auction
     * and the bid history of each item
     * @param auction the auction to review
     */
    public void reviewResults(Auction auction)
    {
        HashMap<Integer, Item> donorsInAuction = auction.getmapOfItems();
        double totalMoneyRaised = 0;

        if(donorsInAuction != null)
        {
            //loop through map of donors and their associated items
            for(Map.Entry donors: donorsInAuction.entrySet())
            {
                double moneyRaisedByThisDonor = 0;
                Donor donor = (Donor) donors.getKey();
                //get the set of items for current donor in map
                Set<Item> itemsDonated = donor.getItemsDonated();

                for(Item item: itemsDonated)
                {
                    //get the bidders of current item
                    TreeMap<Double, Bidder> biddersForThisItem = item.getBiddersForThisItem();
                    if(!biddersForThisItem.isEmpty())
                    {
                        //if there are bidders, get the winning bid and add it to money raised
                        double highestBid = item.getCurrentHighestBid();
                        moneyRaisedByThisDonor += highestBid;
                    }

                }

                System.out.println(donor.toString() + " raised " + moneyRaisedByThisDonor);
                totalMoneyRaised += moneyRaisedByThisDonor;
            }
        }

        System.out.println("Total money raised for this event: " + totalMoneyRaised);


        List<Item> itemsInAuction = auction.getItemsInAuction();

        for(Item item: itemsInAuction)
        {
            //for every item in the auction, get all the bids associated with that item
            System.out.println("Bidding history for: " + item);
            //since TreeMaps are sorted, will automatically be in chronological order
            TreeMap<Double, Bidder> biddersForThisItem = item.getBiddersForThisItem();

            if(!biddersForThisItem.isEmpty())
            {
                //loop through bidding history of item
                for(Map.Entry bidders: biddersForThisItem.entrySet())
                {
                    double bid = (double) bidders.getKey();
                    Bidder bidder = (Bidder) bidders.getValue();

                    System.out.println("Bidder: " +  bidder + "\tBid: " + bid);
                }

            }else
                System.out.println("No bids for " + item + ".");
        }

    }
}
