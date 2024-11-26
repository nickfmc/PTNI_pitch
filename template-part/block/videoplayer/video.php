<?php

/**
 * blockname Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'c-accessible-video-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'c-accessible-video';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if( $is_preview ) {
    $className .= ' is-admin';
}
$video_url = get_field('video');

$video_has_audio = get_field('video_has_audio');
$video_attributes = '';

if (!$video_has_audio) {
    $video_attributes = 'aria-label="This video has no audio track" muted';
}

$transcript_content = get_field('transcript');
?>

<div id="<?php echo esc_attr($id); ?>" class="alignfull <?php echo esc_attr($className); ?>">
    <div class="video-player" role="region" aria-label="Video Player<?php echo !$video_has_audio ? ' with No Audio' : ''; ?>" aria-describedby="transcript-<?php echo esc_attr($id); ?>">
        <div class="c-play-icon">
             <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="m9.524 4.938l10.092 6.21a1 1 0 0 1 0 1.704l-10.092 6.21A1 1 0 0 1 8 18.21V5.79a1 1 0 0 1 1.524-.852"/></svg>
        </div>
        <?php
        $image = get_field('poster');
        $size = 'large';
        if($image){
            $image_url = wp_get_attachment_image_url($image, $size);
            $videoposter = esc_url($image_url);
        }
        ?>
        <video <?php echo $video_attributes; ?> poster="<?php echo $videoposter;?>">
            <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
            <track kind="captions" src="captions.vtt" srclang="en" label="English">
            Your browser does not support the video tag.
        </video>
        <div class="controls">
            <div>
                <button class="play-pause" aria-label="Play/Pause">Play</button>
                <?php if ($video_has_audio): ?>
                    <button class="mute" aria-label="Mute/Unmute">Mute</button>
                <?php endif; ?>
                <!-- <button class="cc" aria-label="Toggle Captions">CC</button> -->
                <button class="transcript-toggle" aria-controls="transcript-<?php echo esc_attr($id); ?>" aria-expanded="false" aria-label="Toggle Transcript">Transcript</button>
            </div>
            <div class="progress-container" role="slider" aria-label="Video Timeline" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar"></div>
            </div>
        </div>
    </div>
    <?php if ($transcript_content): ?>
        <div id="transcript-<?php echo esc_attr($id); ?>" class="transcript" hidden aria-labelledby="transcript-heading-<?php echo esc_attr($id); ?>">
            <h2 id="transcript-heading-<?php echo esc_attr($id); ?>" class="is-style-u-eyebrow-heading">Transcript</h2>
            <p><?php echo $transcript_content; ?></p>
        </div>
    <?php endif; ?>
</div>