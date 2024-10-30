<div class="wrap">
    <div class="icon32" id="icon-options-general"><br/></div>
    <h2>Mailsystem Settings</h2>

    <form method="post" id="options">
        <?php wp_nonce_field(MailsystemOptionsManager::OPTIONS_NAME . '_config'); ?>
        <h3>API</h3>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">end point</th>
                <td>
                    <input name="api_end_point" type="text" id="api_end_point" size="50"
                           value="<?php echo stripslashes(htmlspecialchars($options['api']['end_point'])); ?>"/><br/>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">token</th>
                <td>
                    <input name="api_token" type="text" id="api_token" size="50" maxlength="32"
                           value="<?php echo stripslashes(htmlspecialchars($options['api']['token'])); ?>"/><br/>
                </td>
            </tr>
        </table>
        <h3>Statistics</h3>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">cache (min)</th>
                <td>
                    <input name="statistics_cache" type="text" id="statistics_cache" size="50"
                           value="<?php echo stripslashes(htmlspecialchars($options['statistics']['cache'])); ?>"/><br/>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" value="Save settings"
                   name="<?php echo MailsystemOptionsManager::OPTIONS_NAME; ?>_config_save" class="button-primary"/>
        </p>
    </form>
</div>