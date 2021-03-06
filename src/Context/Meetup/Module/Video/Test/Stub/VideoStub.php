<?php

namespace CodelyTv\Context\Meetup\Module\Video\Test\Stub;

use CodelyTv\Context\Meetup\Module\Video\Domain\Video;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoId;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoTitle;
use CodelyTv\Context\Meetup\Module\Video\Domain\VideoUrl;
use CodelyTv\Shared\Domain\CourseId;
use CodelyTv\Shared\Test\Stub\CourseIdStub;

final class VideoStub
{
    public static function create(VideoId $id, VideoTitle $title, VideoUrl $url, CourseId $courseId)
    {
        return new Video($id, $title, $url, $courseId);
    }

    public static function random() : Video
    {
        return self::create(
            VideoIdStub::random(),
            VideoTitleStub::random(),
            VideoUrlStub::random(),
            CourseIdStub::random()
        );
    }
}
