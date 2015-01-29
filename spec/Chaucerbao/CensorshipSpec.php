<?php namespace spec\Chaucerbao;

use PhpSpec\ObjectBehavior;

class CensorshipSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Chaucerbao\Censorship');
    }

    public function it_censors_banned_words()
    {
        $this->load(['rainbow', 'flower', 'sugar']);
        $this->censor('While on a sugar high, she picked a flower with rainbow colors.')->shouldReturn('While on a ***** high, she picked a ****** with ******* colors.');
    }

    public function it_censors_banned_word_inflections()
    {
        $this->load(['candy', 'kitten', 'smile']);
        $this->censor('When kittens eat candied apples, they have smiles on their faces.')->shouldReturn('When ******* eat ******* apples, they have ****** on their faces.');
    }

    public function it_uses_the_custom_default_symbol()
    {
        $this->setSymbol('-');
        $this->load(['cute', 'pretty']);
        $this->censor('That piggy was pretty cute!')->shouldReturn('That piggy was ------ ----!');
    }

    public function it_uses_the_symbol_override_parameter()
    {
        $this->load(['sweet', 'chocolate']);
        $this->censor('The best chocolate candies are sweet.', 'x')->shouldReturn('The best xxxxxxxxx candies are xxxxx.');
    }

    public function it_retains_multiple_spaces()
    {
        $this->load(['not', 'important']);
        $this->censor('  A  B  C  ')->shouldReturn('  A  B  C  ');
    }
}
