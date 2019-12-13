package com.example.cmaalouf.uxauction;

import java.util.HashMap;
import java.util.HashSet;
import java.util.List;
import java.util.Map;
import java.util.Set;
import java.util.TreeMap;

public class Bidder
{
    private String username;
    private String password;
    private String firstName;
    private String lastName;
    private String emailAddress;
    private String billingInfo;
    private boolean autoBid;
    protected Map<Item, Double> itemsCurrentlyBidOn; //map of items associated with the amount bid


    public Bidder(String username, String password, String firstName, String lastName, String emailAddress, String billingInfo)
    {
        this.username = username;
        this.password = password;
        this.firstName = firstName;
        this.lastName = lastName;
        this.emailAddress = emailAddress;
        this.billingInfo = billingInfo;
        this.autoBid = false;
        itemsCurrentlyBidOn = new HashMap<>();

    }

    /**
     * MAYBE MOVE TO SYSTEM CLASS?
     * Purpose: Add the bidder to a list of known bidders
     * @param listOfBidders the list to add to
     * @return
     */
    public void signUp(List<Bidder> listOfBidders)
    {
        listOfBidders.add(this);

    }

    /**
     * MAYBE MOVE TO SYSTEM CLASS?
     * @param bidder the bidder trying to sign in
     * @param listOfSignedInBidders the list of bidders currently using the system
     * @param listOfAllBidders the list of bidders who have signed up
     */
    public void signIn(Bidder bidder, List<Bidder> listOfSignedInBidders, List<Bidder> listOfAllBidders)
    {
        //check if they're in the list of known bidders and that their information is correct
        if(this.equals(bidder) && listOfAllBidders.contains(bidder))
        {
            listOfSignedInBidders.add(bidder);

        }
        else
            System.out.println("Invalid username or password.");

    }

    /**
     * Purpose: Turn auto-bid on/off
     * @param bidToSet the bid to set
     * @return
     */
    public int setAutoBid(int bidToSet)
    {
        //if auto-bid is false, set it to true and return the bid value
        if(!this.autoBid)
        {
            this.autoBid = true;
            return bidToSet;
        }
        //otherwise, turn it off
        else
        {
            this.autoBid = false;
            return 0;
        }
    }

    /**
     * Purpose: allow a bidder to change their password
     * @param newPassword the new password
     * @return the new password
     */
    public String changePassword(String newPassword)
    {
        this.password = newPassword;
        return password;
    }

    /**
     * Purpose: Print all the bids that the bidder is not the highest bidder for
     */
    public void viewPastBids()
    {
        //don't want to modify the map of items they have bid on
        HashMap<Item, Double> tempItemsBidOn = new HashMap<>(itemsCurrentlyBidOn);

        //if they have bid on items
        if(itemsCurrentlyBidOn != null)
        {
            //loop through the map of items they have bid on
            for (Map.Entry items : itemsCurrentlyBidOn.entrySet())
            {
                //get current item
                Item item = (Item)items.getKey();
                //get bidders associated with this item
                TreeMap<Double, Bidder> biddersForThisItem = item.getBiddersForThisItem();
                //get the highest bid for this item
                double highestAmount = biddersForThisItem.lastKey();
                //get bidder associated with highest amount
                Bidder highestBidder = biddersForThisItem.get(highestAmount);
                //if the bidder is the highest bidder, remove this item
                if(highestBidder.equals(this))
                    tempItemsBidOn.remove(item);
            }

            //Print bids
            System.out.println("Your past bids:\n");

            for(Map.Entry pastBids: tempItemsBidOn.entrySet())
            {
                Item item = (Item)pastBids.getKey();
                Double bid = (Double)pastBids.getValue();
                System.out.println("Item: " + item + "\tYour bid: " + bid);
            }
        }

        if(tempItemsBidOn.isEmpty())
            System.out.println("You have no past bids.");
    }

    /**
     * Purpose: Print out the items that the bidder is the highest bidder for
     */
    public void viewItemsHighestBid()
    {
        //set to print
        Set<Item> itemsWithHighestBid = new HashSet<>();

        //if they have bid on items
        if(itemsCurrentlyBidOn != null)
        {
            //loop through the map of items they have bid on
            for(Map.Entry items: itemsCurrentlyBidOn.entrySet())
            {
                //get current item
                Item item = (Item)items.getKey();
                //get bidders associated with this item
                TreeMap<Double, Bidder> biddersForThisItem = item.getBiddersForThisItem();
                //get the highest bid for this item
                double highestAmount = biddersForThisItem.lastKey();
                //get bidder associated with highest amount
                Bidder highestBidder = biddersForThisItem.get(highestAmount);
                //if the bidder is the highest bidder, add this item to set to print
                if(highestBidder.equals(this))
                    itemsWithHighestBid.add(item);

            }
            //print final set
            if(!itemsWithHighestBid.isEmpty())
                for(Item item: itemsWithHighestBid)
                {
                    System.out.println("You are the highest bidder for: " + item.toString());
                    System.out.println("Your bid for this item is: " + item.getCurrentHighestBid());
                }
        }

        if(itemsWithHighestBid.isEmpty() )
            System.out.println("You are not the highest bidder for any items.");


    }


    /**
     * Purpose: Have a way to compare bidders
     * @param o the bidder to compare to
     * @return true if they're equal, false if not
     */
    @Override
    public boolean equals(Object o)
    {
        return this.username.equals(((Bidder) o).username) && this.password.equals(((Bidder) o).password);
    }

    /**
     * Purpose: set the max bid for a bidder
     * @param maximumAutoBid the amount to set
     * @return the amount to set
     */
    public int setMaximumAutoBid(int maximumAutoBid)
    {
        return maximumAutoBid;
    }

    /**
     * Purpose: bid on an item
     * @param itemToBidOn the item to bid on
     * @param amount the amount to bid
     */
    public void bid(Item itemToBidOn, double amount)
    {
        //update map of items this bidder has bid on
        itemsCurrentlyBidOn.put(itemToBidOn, amount);
        TreeMap<Double, Bidder> biddersForThisItem = itemToBidOn.getBiddersForThisItem();
        //update map of bidders for an item
        biddersForThisItem.put(amount, this);
    }

    /**
     * Purpose: tell java how to print bidders
     * @return the string to print
     */
    public String toString()
    {
        String str = "";
        str += this.username;
        return str;
    }
}
