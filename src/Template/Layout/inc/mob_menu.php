<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <ul class="nav">
            <?php foreach ($nav_menu as $key): ?>
                <li class="<?= (FA == $key->alias)? 'active' : '' ?>"><a href="<?= $this->Url->build(RS.$key->alias) ?>" <?= ($key->target == 1) ? "target='_blank'" : "" ?>><?php echo $key->name; ?></a></li>
            <?php endforeach ?>
        </ul>
    </ul>

    <button data-toggle="modal" data-target="#test_drive_modal">Заказать тест-драйв</button>

    <table>
        <tbody>
            <tr>
                <?php echo (isset($fb_link) && $fb_link != "" ? "<td><a href='".$fb_link."' target='_blank' ><img src='".$this->Url->build('/img/fb_y.png')."' alt='Facebook' /></a></td>" : ""); ?>
                <?php echo (isset($vk_link) && $vk_link != "" ? "<td><a href='".$vk_link."' target='_blank' ><img src='".$this->Url->build('/img/vk_y.png')."' alt='VK' /></a></td>" : ""); ?>
                <?php echo (isset($gp_link) && $gp_link != "" ? "<td><a href='".$gp_link."' target='_blank' ><img src='".$this->Url->build('/img/g_y.png')."' alt='Google +' /></a></td>" : ""); ?>
                <?php echo (isset($yt_link) && $yt_link != "" ? "<td><a href='".$yt_link."' target='_blank' ><img src='".$this->Url->build('/img/yt_y.png')."' alt='Youtube' /></a></td>" : ""); ?>
            </tr>
        </tbody>
    </table>
</div>

<div class="mob_menu_header">
    <a href="<?= $this->Url->build(RS) ?>" class="logo">
        <img src="<?= $this->Url->build(BANNER_PATH.$mobile_logo['file']) ?>" alt="Logo" class="logo_img_wh"/>
    </a>
</div>

<div class="corner"></div>
<div class="dark-bg"></div>
<div id="menu_btn">
    <img src="<?= $this->Url->build('/img/menu_btn.png') ?>" alt="Menu" />
</div>

