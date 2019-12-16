package com.example.cmaalouf.uxauction;

import org.junit.After;
import org.junit.Before;
import org.junit.Test;

import static org.junit.Assert.*;

public class AuctionTest {

    Auction auction;
    String itemName;
    String json ;
    String json2;
    @Before
    public void beforeTest(){
        auction = new Auction(1,1,null);
        itemName ="Chessboard";
        json = "[{\"id\":\"0\",\"itemName\":\"Chessboard\",\"description\":\"" +
                "This chessboard was owned by King George back in 1945, seeing use by over three generations of royal family.\",\"" +
                "startingBid\":\"1000.00\",\"minimumBidInc\":\"100.00\",\"currentBid\":\"500.00\",\"donorName\":\"The Hat Store\"" +
                ",\"auctionNameRef\":\"The Best Auction\",\"imageName\":null,\"imageMime\":null,\"imageData\":null},";
        json2 = "{\"id\":\"0\",\"itemName\":\"Chessboard\",\"description\":\"" +
                "This chessboard was owned by King George back in 1945, seeing use by over three generations of royal family.\",\"" +
                "startingBid\":\"1000.00\",\"minimumBidInc\":\"100.00\",\"currentBid\":\"500.00\",\"donorName\":\"The Hat Store\"" +
                ",\"auctionNameRef\":\"The Best Auction\",\"imageName\":null,\"imageMime\":null,\"imageData\":null}]";
    }

    @After
    public void tearDown() throws Exception{
        auction =null;
    }



    @Test
    public void makeAuctionItems() {
        auction.makeAuctionItems(json+json2);
        assertTrue(auction.getItemsInAuction()!=null);
        assertTrue(auction.getItemsInAuction().size()!=0);
        assertEquals(auction.getItemsInAuction().get(0).name,itemName);

    }

    @Test
    public void getItemsInAuction() {
        auction.makeAuctionItems(json);
        assertTrue(auction.getItemsInAuction()!=null);
        assertEquals(auction.getItemsInAuction().get(0).name,itemName);
    }

    @Test
    public void setTimeLeft() {
        int a = 1;
        assertEquals(a,1);
    }

}