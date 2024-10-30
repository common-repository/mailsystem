<div class="wrap">
    <div class="icon32" id="icon-options-general"><br/></div>
    <h2>Mailsystem Statistics</h2>

    <h3>Last 5 Letters</h3>
    <table class="form-table">
        <?php if (!empty($letters)): ?>
            <tr valign="top" class="header">
                <td class="date">Date</td>
                <td>Subject</td>
            </tr>
            <?php foreach ($letters as $idx => $letter): ?>
                <?php if(5 == $idx) break;?>
                <tr valign="top">
                    <td class="date"><?php echo date('d.m.Y',strtotime($letter->date_create));?></td>
                    <td><?php echo $letter->subject;?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>

<style>
    table.form-table{
        border: 1px solid #808080;
        border-collapse: collapse;
        width: 700px;
    }
    table.form-table tr td{
        border: 1px dotted #808080;
        padding: 8px;
    }
    table.form-table tr.header{
        border: 1px solid #808080;
        font-weight: 900;
        background: #d3d3d3;
    }
    table.form-table tr td.date{
        width: 50px;
    }
</style>