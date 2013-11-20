<?php
class BenefitVoteTest extends TestCase {
    public function testVote()
    {
        $expected = new BenefitVote();
        $result = BenefitVote::saveVote(1, 7, 10);
        $this->assertEquals(get_class($expected), get_class($result));
        $this->assertEquals($result->vote, 10);
    }

    public function testVoteTwice()
    {
        $expected = new BenefitVote();
        $result = BenefitVote::saveVote(1, 7, 10);
        $this->assertEquals($result->vote, 10);
        $this->assertEquals(get_class($expected), get_class($result));
        $result = BenefitVote::saveVote(1, 7, 1);
        $this->assertEquals($result->vote, 1);
        $this->assertEquals(get_class($expected), get_class($result));
    }

    public function testBenefitRating()
    {
        $vote = BenefitVote::saveVote(1, 7, 10);
        $benefit = Benefit::find(1);
        $new_rating = Benefit::calculateRating(1);
        $this->assertEquals($benefit->rating, $new_rating);
    }

    public function testBenefitRatingRecalculation()
    {

    }
} 