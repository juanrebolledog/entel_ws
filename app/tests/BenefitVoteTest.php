<?php
class BenefitVoteTest {
    public function setUp()
    {
        parent::setUp();
        $this->benefit = Benefit::take(1)->first();
    }
    public function testVote()
    {
        $expected = new BenefitVote();
        $result = BenefitVote::saveVote($this->benefit->id, 7, 10);
        $this->assertEquals(get_class($expected), get_class($result));
        $this->assertEquals($result->vote, 10);
    }

    public function testVoteTwice()
    {
        $expected = new BenefitVote();
        $result = BenefitVote::saveVote($this->benefit->id, 7, 10);
        $this->assertEquals($result->vote, 10);
        $this->assertEquals(get_class($expected), get_class($result));
        $result = BenefitVote::saveVote($this->benefit->id, 7, 1);
        $this->assertEquals($result->vote, 1);
        $this->assertEquals(get_class($expected), get_class($result));
    }

    public function testBenefitRating()
    {
        $vote = BenefitVote::saveVote($this->benefit->id, 7, 10);
        $benefit = Benefit::find($this->benefit->id);
        $new_rating = Benefit::calculateRating($this->benefit->id);
        $this->assertEquals($benefit->rating, $new_rating);
    }

    public function testBenefitRatingRecalculation()
    {

    }
} 