package com.example.cmaalouf.uxauction;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.HashSet;
import java.util.List;
import java.util.Set;
import java.sql.*;

public class Auction
{
    private ArrayList<Item> itemsInAuction;
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
    private String json;
    private String access ="https:mysql://cs-database.cs.loyola.edu/jorochial";
    private String user = "?user=cmmaalouf&password=1732813";
    private String time = "&serverTimezone=UTC";

    public Auction(int startTime, int endTime, ArrayList<Item> itemsInAuction)
    {
        this.startTime = startTime;
        this.endTime = endTime;
        this.beneficiary = beneficiary;
        this.itemsInAuction = itemsInAuction;
        //this.json = json;
        donorsOfItems = new HashMap<>();
        //makeAuctionItems(json);

    }


//HEAD
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
     * Make items based off data from the server
     * @param jsonData the data to read in to make the items
     */
    protected void makeAuctionItems(String jsonData) {
        try {
            JSONArray jsonArray = new JSONArray(jsonData);
            for (int i = 0; i < jsonArray.length(); i++) {
                JSONObject jsonObject = (JSONObject) jsonArray.get(i);
                String name = jsonObject.get("itemName").toString();
                String desc = jsonObject.get("description").toString();
                String donor = jsonObject.get("donorName").toString();
                Double startingBid = Double.valueOf(jsonObject.get("startingBid").toString());
                Double minInc = Double.valueOf(jsonObject.get("minimumBidInc").toString());
                Item item = new Item(name, desc, startingBid, minInc, donor);
                itemsInAuction.add(item);
            }
        } catch (JSONException e) {
            e.printStackTrace();
        }
    }



    /**
     * Purpose: Give other classes, namely the system, access to an auctions list of items
     * @return the list of items in the auction
     */
    public ArrayList<Item> getItemsInAuction()
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
