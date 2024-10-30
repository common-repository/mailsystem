<div class="wrap">
    <div class="icon32" id="icon-options-general"><br/></div>
    <h2>Mailsystem Letters</h2>

    <h3>Import all Posts from Selected Category to Letters</h3>
    <form method="post">
        <?php wp_nonce_field(MailsystemOptionsManager::OPTIONS_NAME . '_config'); ?>
        <b>Category</b>
        <?php wp_dropdown_categories(); ?>
        <input type="hidden" name="type" value="publish"/>
        <b>Send From</b>
        <select name="send_from" id="send_from1">
            <?php if (!empty($aSendFrom)): ?>
                <?php foreach ($aSendFrom as $k => $v): ?>
                    <?php var_dump($v); ?>
                    <option value="<?php echo (int)$v->id; ?>"><?php echo $v->from_email ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <input type="submit" value="Import Posts as Letters"
               name="mailsystem_post_category_import" class="button-primary"/>
    </form>
    <hr/>

    <h3>Import Selected Post to Letters</h3>
    <form method="post">
        <?php wp_nonce_field(MailsystemOptionsManager::OPTIONS_NAME . '_config'); ?>
        <b>Post</b>
        <select name="post_id" id="post_id">
        <?php
        global $post;
        $posts = get_posts([
            'post_type' => 'post',
            'post_status' => 'publish',
            'numberposts' => -1
        ]);
        foreach( $posts as $post ) : setup_postdata($post); ?>
            <option value="<? echo $post->ID; ?>"><?php the_title(); ?></option>
        <?php endforeach; ?>
        </select>
        <b>Send From</b>
        <select name="send_from" id="send_from2">
            <?php if (!empty($aSendFrom)): ?>
                <?php foreach ($aSendFrom as $k => $v): ?>
                    <option value="<?php echo (int)$v->id; ?>"><?php echo $v->from_email ?></option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
        <input type="submit" value="Import Selected Post as Letter"
               name="mailsystem_post_import" class="button-primary"/>
    </form>
</div>