<?php

namespace templates;

use Repository\TweetRepository;
use Repository\UserRepository;
use Views\AbstractView;

class TwitterWall extends AbstractView
{

    private $tweets;
    private $userPhotos;

    protected function outputHTML()
    {

        ?>

        <div class="container">

        <?php

        //provjera da li su prijatelji ili da li je to sam korisnik
        if(checkPermissionToTweet()) {

            //forma za dodavanje novih tweetova
            ?>

            <script src="/TwitterApp/assets/js/postTweetForm.js"></script>

            <div class="col-md-4 col-md-offset-4">
                <button id="open" class="btn btn-success btn-block">Post tweet</button>
            </div>

            <form class="form-horizontal" id="tweet-form" role="form" method="post"
                  action="<?php echo \route\Route::get("postTweet")->generate(array("id" => getIdFromURL())); ?>">

                <br><br>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <textarea class="form-control" rows="3" name="content" id="content"
                                  placeholder="What's happening?" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="text" class="form-control" name="tag" id="tag" placeholder="Enter tweet tag (optional)">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <select name="selectPhoto" id="sel1" class="form-control">
                            <option value="">Select photo...</option>
                            <?php
                            foreach($this->userPhotos as $photo) {
                                ?>
                                <option value="<?php echo $photo['path'] ?>"><?php echo $photo['image']?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <div style="color: green" id="success"></div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4 col-md-offset-4">
                        <input type="submit" class="btn btn-info btn-block" name="tweet" id="tweet" value="Tweet">
                    </div>
                </div>

            </form>

            <br><br>

            <?php

        } else {
            ?>
            <div class="col-md-4 col-md-offset-1">
                <p>To post tweet on this wall you need to become friends.</p>
                <hr>
            </div>

            <?php
        }


            $counter = 0;

            //prikaži sve tweetove na korisnikovom zidu
            foreach ($this->tweets as $tweet) {
                $counter++;
                $user = UserRepository::getUserByID($tweet['fromid']);
                $numberOfComments = TweetRepository::getNumberOfComments($tweet['tweetid']);
                $value = "Comments";
                if($numberOfComments == 1) {
                    $value = "Comment";
                }

                ?>

                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-info" id="comments">
                        <div class="panel-heading">
                            <h3 class="panel-title">Posted by: <?php echo $user['username'] ?></h3>
                        </div>

                        <div class="panel-body">
                            <div>
                                <?php
                                    echo parseText($tweet['content']);
                                ?>
                            </div>
                        </div>

                        <div class="panel-footer">
                            <div>
                                <a href="<?php echo \route\Route::get("viewTweet")->generate(array("id" => $tweet['tweetid'])); ?>"><?php echo $numberOfComments . ' ' . $value?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }

            //ako nema tweetova, obavijeti korisnika
            if($counter == 0) {
                ?>
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-info" id="comments">
                        <div class="panel-heading">
                            <h3 class="panel-title">Tweets</h3>
                        </div>
                        <div class="panel-body">
                            There are no tweets to show.
                        </div>
                    </div>
                </div>
                <?php
            }

            ?>
        </div>

        <?php
    }

    /**
     * @return mixed
     */
    public function getTweets()
    {
        return $this->tweets;
    }

    /**
     * @param mixed $tweets
     */
    public function setTweets($tweets)
    {
        $this->tweets = $tweets;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserPhotos()
    {
        return $this->userPhotos;
    }

    /**
     * @param mixed $userPhotos
     */
    public function setUserPhotos($userPhotos)
    {
        $this->userPhotos = $userPhotos;
        return $this;
    }

}