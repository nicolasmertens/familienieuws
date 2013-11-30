<?php if($user):?>

    <a id="fb-logout" href="<?php echo $facebookWrapper->getLogoutUrl(); ?>">Afmelden</a>

    <div>
        <h3>user info</h3>
        <p>id: <?php echo $user['id']; ?></p>
        <p>firstname: <?php echo $user['first_name']; ?></p>
        <p>lastname: <?php echo $user['last_name']; ?></p>
        <p>email: <?php echo $user['email']; ?></p>
    </div>

    <div>
        <h3>Feed</h3>
        
        <?php foreach($fbPhotoFeed->getPhotoFeed() as $photo): ?>
        <div>
            <p><?php if(isset($photo['name'])) echo $photo['name']; ?></p>
            <img src="<?php echo $photo['images'][0]['source']; ?>"></img>
        </div>
        <?php endforeach; ?>
        
    </div>

<?php else: ?>

    <a id="fb-login" href="#fb-login">Aanmelden met Facebook</a>

<?php endif; ?>