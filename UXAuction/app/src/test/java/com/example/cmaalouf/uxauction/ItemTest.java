package com.example.cmaalouf.uxauction;

import org.junit.After;
import org.junit.Before;
import org.junit.Test;

import java.util.ArrayList;
import java.util.TreeMap;

import static org.junit.Assert.*;

public class ItemTest {
    private Item item;
    private String name;
    private Double startbid;
    private int startTime = 1;
    private int endTime = 3;
    private ArrayList<Item> items = new ArrayList<>();
    private Auction auction;
    private Donor donor;
    private Bidder bidder;

    @Before
    public void beforeTest()
    {
        name = "chess";
        startbid = 10.00;
        item = new Item("chess","a board game",10.00, 1.00, "Dr.Raunak");
        auction = new Auction(startTime, endTime, items);
        donor = new Donor("name", "rep", "410", "address", "email");
        bidder = new Bidder("username", "password", "first", "last", "email", "billing");
        auction.addItem(item, donor);
        bidder.bid(item, 25.0);
    }

    @After
    public void tearDown()
    {
        name =null;
        startbid = null;
        item =null;
    }

    @Test
    public void getBiddersForThisItem() {
        assertTrue(item.getBiddersForThisItem()!=null);
        TreeMap<Double, Bidder> bidders = item.getBiddersForThisItem();
        assertTrue(bidders.containsKey(25.0));
        assertTrue(bidders.containsValue(bidder));

    }

    @Test
    public void getCurrentHighestBid() {
        assertTrue(item.getBiddersForThisItem()!=null);
        assertTrue(item.getCurrentHighestBid()>0);
        double highestBid = item.getCurrentHighestBid();
        assertTrue(highestBid == 25.0);

    }

    @Test
    public void testDescription()
    {
        assertTrue(item.getItemDescription().equals("a board game"));
    }

    @Test
    public void testStartingBid()
    {
        assertTrue(item.getStartingBid() == 10.0);
    }

    @Test
    public void testString() {
        assertEquals(item.toString(),name+": "+startbid);

    }
}