package com.example.cmaalouf.uxauction;

import org.junit.After;
import org.junit.Before;
import org.junit.Test;

import static org.junit.Assert.*;

public class DonorTest {
    String name;
    String representativeName;
    String phoneNumber;
    String address;
    String emailAddress;
    Donor donor;
    
    @Before
    public void beforetest()
    {
        donor = new Donor(name, representativeName, phoneNumber, address, emailAddress);
    }
    
    @After
    public void tearDown()
    {
          name = null;
          representativeName = null;
          phoneNumber = null;
          address = null;
          emailAddress = null;
          donor = null;
    }
    
    
    
    @Test
    public void getItemsDonated() {
       
        assertTrue(donor.getItemsDonated()!=null);
    }

    @Test
    public void testString() {
        
        assertEquals(donor.toString(), name);
    }
}