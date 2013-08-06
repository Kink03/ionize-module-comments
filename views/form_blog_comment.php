<!-- Comments module's reply form -->

<div class="divider"></div> 
    <div id="respond">

        <form action="<ion:url/>#reply" method="post" id="replyform">		

            <h4>Your reply</h4>



            <p>	
                <label for="author">Your nickname</label><br />
                <input id="author" name="author" type="text" tabindex="1" />
            </p>

            <p>
                <label for="email">Your email, won't be published (required)</label><br />
                <input id="email" name="email" value="" type="text" tabindex="2" />
            </p>

            <p>
                <label for="site">Website</label><br />
                <input id="site" name="site" value="" type="text" tabindex="3" />
            </p>	

            <p>
                <label for="content">Your Message</label><br />
                <textarea id="message" name="content" rows="10" cols="20" tabindex="4"></textarea>
            </p>
            <input type="hidden" name="ip" value="<?=$_SERVER['REMOTE_ADDR']?>" type="text" />

            <p class="no-border">
                <input class="button" type="submit" value="Send" tabindex="5" />
            </p>

        </form>	
    </div>
