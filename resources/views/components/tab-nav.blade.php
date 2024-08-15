<div class="tab tab-nav-boxed tab-nav-outline appear-animate">
    <ul class="nav nav-tabs justify-content-center" role="tablist">
        @foreach ($tabs as $tab)
            <li class="nav-item mr-2 mb-2">
                <a class="nav-link {{ $loop->first ? 'active' : '' }} br-sm font-size-md ls-normal" href="#{{ $tab['id'] }}">{{ $tab['label'] }}</a>
            </li>
        @endforeach
    </ul>
</div>
