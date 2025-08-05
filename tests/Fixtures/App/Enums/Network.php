<?php

namespace Tests\Fixtures\App\Enums;

use Beebmx\KirbyEnum\Contracts\HasLabel;

enum Network: string implements HasLabel
{
    case Facebook = 'facebook';
    case Instagram = 'instagram';
    case TikTok = 'tiktok';
    case X = 'x';
    case YouTube = 'youtube';

    public function toLabel(): string
    {
        return match ($this) {
            self::Facebook => 'Network facebook',
            self::Instagram => 'Network instagram',
            self::TikTok => 'Network tikTok',
            self::X => 'Network X (twitter)',
            self::YouTube => 'Network youTube',
        };
    }

    public static function vertical(): array
    {
        return [
            self::Instagram,
            self::TikTok,
        ];
    }
}
