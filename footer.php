<?php get_template_part('template-parts/footer/footer-1');
    $copyright = get_theme_mod('footer_copyright', 'default');

?>



<div class="sub-footer">
    <p><?php echo __($copyright); ?></p>
</div>
<?php wp_footer(); ?>
</body>

</html>