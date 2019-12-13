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
        HashMap<Donor, Set<Item>> donorsInAuction = auction.getDonorsOfItems();
        double totalMoneyRaised = 0;

        if(donorsInAuction != null)
        {
            for(Map.Entry donors: donorsInAuction.entrySet())
            {
                double moneyRaisedByThisDonor = 0;
                Donor donor = (Donor) donors.getKey();
                System.out.println("Current donor: " + donor);
                Set<Item> itemsDonated = donor.getItemsDonated();

                for(Item item: itemsDonated)
                {
                    System.out.println("Current item: " + item);

                    TreeMap<Double, Bidder> biddersForThisItem = item.getBiddersForThisItem();
                    if(!biddersForThisItem.isEmpty())
                    {
                        double highestBid = item.getCurrentHighestBid();
                        System.out.println("Highest Bid: " + highestBid);
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
            System.out.println("Bidding history for: " + item);
            TreeMap<Double, Bidder> biddersForThisItem = item.getBiddersForThisItem();

            if(!biddersForThisItem.isEmpty())
            {
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
