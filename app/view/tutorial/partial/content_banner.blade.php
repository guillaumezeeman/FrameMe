<table class="content-header">
    <tr>
        <td width="25%">&nbsp;</td>
        <td width="50%" colspan="2">
            <div class="banner-container">
                <img src="{{ image('frame_me_blue.png') }}" class="banner">
            </div>
        </td>
        <td width="25%" class="vertical-bottom">
            <div class="navigation-container justify-flex-end">
                @if ( ! empty($navigation_left))
                    <span class="navigation {{ $navigation_left }}-btn"><span class="navigation-icon ti-arrow-left"></span></span>
                @endif

                @if ( ! empty($navigation_right))
                        <span class="navigation {{ $navigation_right }}-btn"><span class="navigation-icon ti-arrow-right"></span></span>
                @endif
            </div>
        </td>
    </tr>
</table>