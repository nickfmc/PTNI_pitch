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
$id = 'c-project-swiper-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'c-project-swiper';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}
if( $is_preview ) {
    $className .= ' is-admin';
}


?>

 
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> ">





<div class="swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide swiper-slide-3112">
          <img
            class="swiper-slide-bg-image swiper-slide-bg-image-c61b"
            loading="lazy"
            src="https://cdn.studio.swiperjs.com/maroon-gregar-typho-175/0c4113589e774cf7de0c.JPG"
          />

          <div class="swiper-lazy-preloader"></div>

          <div class="swiper-slide-content swiper-slide-content-c568">
            <div class="swiper-slide-block swiper-slide-block-5d53">
              <div class="swiper-slide-text swiper-slide-text-8edf">
                Ghostwire: Tokyo
              </div>
              <div class="swiper-slide-text swiper-slide-text-f7f1">
                After strange disappearances hit Tokyo’s population, it’s up to
                you to uncover the source and purge the city of a strange, new
                evil
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide swiper-slide-3112">
          <img
            class="swiper-slide-bg-image swiper-slide-bg-image-c61b"
            loading="lazy"
            src="https://cdn.studio.swiperjs.com/maroon-gregar-typho-175/cb3c71b32278297d39c4.png"
          />

          <div class="swiper-lazy-preloader"></div>

          <div class="swiper-slide-content swiper-slide-content-c568">
            <div class="swiper-slide-block swiper-slide-block-5d53">
              <div class="swiper-slide-text swiper-slide-text-8edf">Stray</div>
              <div class="swiper-slide-text swiper-slide-text-f7f1">
                Lost, alone, and separated from family, a stray cat must
                untangle an ancient mystery to escape a long-forgotten cybercity
                and find the way home
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide swiper-slide-e41e">
          <img
            class="swiper-slide-bg-image swiper-slide-bg-image-c61b"
            loading="lazy"
            src="https://api.rawg.io/media/resize/1280/-/games/3e8/3e81585ecda204d4f4b80a041b069adb.jpg/"
          />

          <div class="swiper-lazy-preloader"></div>

          <div class="swiper-slide-content swiper-slide-content-c568">
            <div class="swiper-slide-block swiper-slide-block-5d53">
              <div class="swiper-slide-text swiper-slide-text-8edf">
                S.T.A.L.K.E.R. 2
              </div>
              <div class="swiper-slide-text swiper-slide-text-f7f1">
                S.T.A.L.K.E.R. 2 is a brand-new entry in the legendary series,
                enjoyed by millions of players worldwide
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide swiper-slide-e41e">
          <img
            class="swiper-slide-bg-image swiper-slide-bg-image-c61b"
            loading="lazy"
            src="https://api.rawg.io/media/resize/1280/-/games/85d/85dc9149fe3d2c9fed5d0d73cd9940f7.jpg/"
          />

          <div class="swiper-lazy-preloader"></div>

          <div class="swiper-slide-content swiper-slide-content-c568">
            <div class="swiper-slide-block swiper-slide-block-5d53">
              <div class="swiper-slide-text swiper-slide-text-8edf">
                Senua's Saga: Hellblade II
              </div>
              <div class="swiper-slide-text swiper-slide-text-f7f1">
                Senua's Saga: Hellblade II - the next entry in the Hellblade
                franchise from developer Ninja Theory
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide swiper-slide-e41e">
          <img
            class="swiper-slide-bg-image swiper-slide-bg-image-c61b"
            loading="lazy"
            src="https://api.rawg.io/media/resize/1280/-/games/ba8/ba82c971336adfd290e4c0eab6504fcf.jpg/"
          />

          <div class="swiper-lazy-preloader"></div>

          <div class="swiper-slide-content swiper-slide-content-c568">
            <div class="swiper-slide-block swiper-slide-block-5d53">
              <div class="swiper-slide-text swiper-slide-text-8edf">
                Starfield
              </div>
              <div class="swiper-slide-text swiper-slide-text-f7f1">
                Starfield is the first new universe in 25 years from Bethesda
                Game Studios
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide swiper-slide-e41e">
          <img
            class="swiper-slide-bg-image swiper-slide-bg-image-c61b"
            loading="lazy"
            src="https://api.rawg.io/media/resize/1280/-/games/1c3/1c305096502c475c00276c827f0fd697.jpg/"
          />

          <div class="swiper-lazy-preloader"></div>

          <div class="swiper-slide-content swiper-slide-content-c568">
            <div class="swiper-slide-block swiper-slide-block-5d53">
              <div class="swiper-slide-text swiper-slide-text-8edf">
                God of War: Ragnarök
              </div>
              <div class="swiper-slide-text swiper-slide-text-f7f1">
                Kratos and Atreus must journey to each of the Nine Realms in
                search of answers as they prepare for the prophesied battle that
                will end the world
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide swiper-slide-e41e">
          <img
            class="swiper-slide-bg-image swiper-slide-bg-image-c61b"
            loading="lazy"
            src="https://api.rawg.io/media/resize/1280/-/games/580/580515de11a1b996918fa3ac118210bc.jpg/"
          />

          <div class="swiper-lazy-preloader"></div>

          <div class="swiper-slide-content swiper-slide-content-c568">
            <div class="swiper-slide-block swiper-slide-block-5d53">
              <div class="swiper-slide-text swiper-slide-text-8edf">
                Teardown
              </div>
              <div class="swiper-slide-text swiper-slide-text-f7f1">
                Plan the perfect heist using creative problem solving, brute
                force and everything around you
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide swiper-slide-e41e">
          <img
            class="swiper-slide-bg-image swiper-slide-bg-image-c61b"
            loading="lazy"
            src="https://api.rawg.io/media/resize/1280/-/games/400/4002e3aa52cf33d184f0f74cc2348134.jpg/"
          />

          <div class="swiper-lazy-preloader"></div>

          <div class="swiper-slide-content swiper-slide-content-c568">
            <div class="swiper-slide-block swiper-slide-block-5d53">
              <div class="swiper-slide-text swiper-slide-text-8edf">
                Forspoken
              </div>
              <div class="swiper-slide-text swiper-slide-text-f7f1">
                Project Athia is the culmination of Luminous Productions’
                philosophy to create a completely new and fresh gaming
                experiences
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide swiper-slide-e41e">
          <img
            class="swiper-slide-bg-image swiper-slide-bg-image-c61b"
            loading="lazy"
            src="https://api.rawg.io/media/resize/1280/-/games/bde/bdef96f7782fba0ff62dabc37ff4b1f0.jpg/"
          />

          <div class="swiper-lazy-preloader"></div>

          <div class="swiper-slide-content swiper-slide-content-c568">
            <div class="swiper-slide-block swiper-slide-block-5d53">
              <div class="swiper-slide-text swiper-slide-text-8edf">
                V Rising
              </div>
              <div class="swiper-slide-text swiper-slide-text-f7f1">
                A Vampire Survival Experience Awaken as a weakened vampire after
                centuries of slumber
              </div>
            </div>
          </div>
        </div>

        <div class="swiper-slide swiper-slide-e41e">
          <img
            class="swiper-slide-bg-image swiper-slide-bg-image-c61b"
            loading="lazy"
            src="https://api.rawg.io/media/resize/1280/-/games/1ae/1ae48966d4c59da2224fe769e93c3af6.jpg/"
          />

          <div class="swiper-lazy-preloader"></div>

          <div class="swiper-slide-content swiper-slide-content-c568">
            <div class="swiper-slide-block swiper-slide-block-5d53">
              <div class="swiper-slide-text swiper-slide-text-8edf">
                Hogwarts Legacy
              </div>
              <div class="swiper-slide-text swiper-slide-text-f7f1">
                Hogwarts Legacy is an immersive, open-world action RPG set in
                the world first introduced in the Harry Potter books
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="swiper-pagination"></div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>




    


</div>


  

