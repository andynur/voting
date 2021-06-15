@props(['href' => '#', 'permission' => false])

<x-utils.link :href="$href" class="btn btn-info btn-sm mb-1" icon="fas fa-search" :text="__('View')" permission="{{ $permission }}" />
