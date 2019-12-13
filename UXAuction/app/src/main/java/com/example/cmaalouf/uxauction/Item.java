package com.example.cmaalouf.uxauction;

import java.util.TreeMap;

public class Item
{
    private double price;
    private String description; //some of these aren't used yet but probably will be
    private int startingBid;
    private int minIncrement;
    private Donor donor;
    private String name;
    private TreeMap<Double, Bidder> biddersForThisItem;

    public Item(String name, double price, String description, int startingBid, int minIncrement, Donor donor)
    {
        this.name = name;
        this.price = price;
        this.description = description;
        this.startingBid = startingBid;
        this.minIncrement = minIncrement;
        this.donor = donor;
        biddersForThisItem = new TreeMap<>();

    }

    /**
     * Purpose: Give other classes access to an items bidders
     * @return map of bids associated with bidders for this item
     */
    public TreeMap<Double, Bidder> getBiddersForThisItem()
    {
        return this.biddersForThisItem;
    }

    /**
     * Purpose: Give other classes access to an items highest bid
     * Each item has a TreeMap of bids associated with bidders
     * Since TreeMaps are sorted, the last key will be associated with the highest bidder
     * @return the highest bid for this item, which is mapped to its respective bidder
     */
    public double getCurrentHighestBid()
    {
        return biddersForThisItem.lastKey();
    }

    /**
     * Purpose: Tell java how to print Item objects
     * @return the string to print
     */
    @Override
    public String toString()
    {
        String str = "";
        str += this.name + ": " + this.price;
        return str;
    }

}
