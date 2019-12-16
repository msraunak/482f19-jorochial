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
