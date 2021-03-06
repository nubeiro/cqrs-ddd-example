<?php

namespace CodelyTv\Context\Meetup\Module\Video\Test\Stub;

use CodelyTv\Context\Meetup\Module\Video\Domain\VideoUrl;
use CodelyTv\Test\Stub\UrlStub;

final class VideoUrlStub
{
    public static function create(string $url)
    {
        return new VideoUrl($url);
    }

    public static function random()
    {
        return self::create(UrlStub::random());
    }
}
