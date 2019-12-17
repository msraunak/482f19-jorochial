package com.example.cmaalouf.uxauction;

public class Bid {

    protected int bidId;
    protected String bidderUName;
    protected double amount;
    protected int itemId;
    public Bid(int bidId, String bidderUName, double amount, int itemId)
    {
        this.bidId=bidId;
        this.bidderUName=bidderUName;
        this.amount = amount;
        this.itemId=itemId;
    }
}
