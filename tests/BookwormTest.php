<?php

/*
 * Copyright (c) Jeroen Visser <jeroenvisser101@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Bookworm\tests;

use Bookworm\Bookworm;

class BookwormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests if the reading time doesn't reach 0 min.
     */
    public function testLessThanMinute()
    {
        // 116 words
        $story = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus auctor leo mauris, quis rutrum mi vulputate vitae. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas.';

        $readingTime = Bookworm::estimate($story, Bookworm::TYPE_SHORT);

        $this->assertEquals('1 min', $readingTime, 'Text with less than a minute to read does not return 1 min.');
    }

    /**
     * Tests if bookworm can properly round to 1 min.
     */
    public function testMinute()
    {
        // 215 words
        $story = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus auctor leo mauris, quis rutrum mi vulputate vitae. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas.';

        $readingTime = Bookworm::estimate($story, Bookworm::TYPE_SHORT);

        $this->assertEquals('1 min', $readingTime, 'Text with a minute to read does not return 1 min.');
    }

    /**
     * Check rounding and large text.
     */
    public function testEightMinutes()
    {
        // 1506 words
        $story = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus auctor leo mauris, quis rutrum mi vulputate vitae. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus auctor leo mauris, quis rutrum mi vulputate vitae. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus auctor leo mauris, quis rutrum mi vulputate vitae. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus auctor leo mauris, quis rutrum mi vulputate vitae. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus auctor leo mauris, quis rutrum mi vulputate vitae. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus auctor leo mauris, quis rutrum mi vulputate vitae. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus auctor leo mauris, quis rutrum mi vulputate vitae. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. ';

        $readingTime = Bookworm::estimate($story, Bookworm::TYPE_SHORT);

        $this->assertEquals('8 min', $readingTime, 'Text with 8 minutes to read does not return 8 min.');
    }

    /**
     * Tests if bookworm can properly work with markdown.
     */
    public function testMarkdown()
    {
        // 215 words
        $story = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus auctor leo mauris, quis rutrum mi vulputate vitae. Aliquam nec *lacus augue*. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius **vehicula**, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas.

        <img src="http://test.com/image.jpg" />

        > Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet.

        #Nullam in purus
        Nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula. ![image](http://test.com/image.jpg)

        ```bash
        $ composer install
        $ composer update
        ```

        <img src="http://test.com/image.jpg" />
        <img src="http://test.com/image.jpg" />

        ## massa magna consectetur
        <picture>
            <source srcset="examples/images/extralarge.jpg" media="(min-width: 1000px)">
            <source srcset="examples/images/art-large.jpg" media="(min-width: 800px)">
            <img srcset="examples/images/art-medium.jpg" alt="…">
        </picture>

        Nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Praesent rutrum nisi dignissim enim eleifend egestas. Nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Praesent rutrum nisi dignissim enim eleifend egestas. Nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Praesent rutrum nisi dignissim enim eleifend egestas. Nulla velit. Nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas. Nulla, non ornare justo urna non velit.';

        $readingTime = Bookworm::estimate($story, Bookworm::TYPE_SHORT);

        $this->assertEquals('3 min', $readingTime, 'Markdown does not return correct timing.');
    }

    /**
     * Tests if the reading time type is set to none.
     */
    public function testTypeNone()
    {
        // 116 words
        $story = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus auctor leo mauris, quis rutrum mi vulputate vitae. Aliquam nec lacus augue. Ut diam nisl, porttitor sit amet mattis eget, vulputate nec mi. Curabitur mi augue, aliquam a fringilla in, sollicitudin vitae sem. Fusce at convallis orci. Curabitur commodo blandit nulla in dignissim. Sed tempus sagittis imperdiet. Nullam in purus nec nibh varius molestie. Pellentesque vel consequat urna. Sed tristique quam justo, vel vestibulum lorem porttitor et. Fusce laoreet, lorem et elementum aliquet, neque nulla imperdiet arcu, a ullamcorper libero leo quis turpis. Fusce feugiat, tellus sit amet varius vehicula, massa magna consectetur nulla, non ornare justo urna non velit. Praesent rutrum nisi dignissim enim eleifend egestas.';

        $readingTime = Bookworm::estimate($story, Bookworm::TYPE_NONE);

        $this->assertEquals('1', $readingTime, 'Text with less than a minute & type NONE does not return 1.');
    }
}
