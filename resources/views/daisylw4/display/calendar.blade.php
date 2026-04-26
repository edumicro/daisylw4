<?php
use Livewire\Component;

/**
 * DaisyLW4 Calendar — Single-File Component
 *
 * Usage:
 *   <livewire:daisylw4.display.calendar :config="[
 *       'mode'     => 'range',          // 'single' | 'range'
 *       'events'   => $this->events,    // array, see shape below
 *       'locale'   => 'pt-BR',
 *       'dayStart' => 6,
 *       'dayEnd'   => 23,
 *       'on' => [
 *           'event-click'  => 'openEdit',       // parent #[On('openEdit')]
 *           'slot-click'   => 'openCreateAt',   // parent #[On('openCreateAt')]
 *           'range-change' => 'onRangeChange',  // parent #[On('onRangeChange')]
 *           'change'       => 'onDateChange',   // parent #[On('onDateChange')] (single mode)
 *       ],
 *   ]" />
 *
 * Event shape:
 *   { id, title, start, end?, color?, active? }
 *   start / end  : 'YYYY-MM-DD' or 'YYYY-MM-DD HH:MM:SS'  (end null = open-ended)
 *   color        : 'primary'|'secondary'|'success'|'warning'|'error'|'info'
 *
 * Callbacks (via 'on'):
 *   event-click  → dispatches Livewire event with { id }
 *   slot-click   → dispatches Livewire event with { date, time, datetime }
 *   range-change → dispatches Livewire event with { from, to }
 *   change       → dispatches Livewire event with { value }
 *
 *   If 'on' is not set, falls back to DOM events:
 *   calendar:event-click | calendar:slot-click | calendar:range-change | calendar:change
 */
new class extends Component {
    public array $config = [];
}; ?>

@php
$cfg = array_merge([
    'mode'     => 'single',
    'events'   => [],
    'locale'   => 'en',
    'dayStart' => 8,
    'dayEnd'   => 18,
    'on'       => [],
], $config ?? []);
@endphp

<div
    x-data="__daisylw4Calendar({
        mode:     '{{ $cfg['mode'] }}',
        events:   {{ Js::from($cfg['events']) }},
        locale:   '{{ $cfg['locale'] }}',
        dayStart: {{ (int) $cfg['dayStart'] }},
        dayEnd:   {{ (int) $cfg['dayEnd'] }},
        on:       {{ Js::from($cfg['on']) }},
    })"
    class="card bg-base-100 select-none"
>
    <div class="card-body p-4 gap-0">

        {{-- ── View toggle + navigation ─────────────────────────────── --}}
        <div class="flex items-center justify-between mb-3 gap-2">
            <div class="join shrink-0">
                <button @click="switchView('month')" class="btn btn-xs join-item"
                        :class="calView === 'month' ? 'btn-neutral' : 'btn-ghost'">Mês</button>
                <button @click="switchView('week')"  class="btn btn-xs join-item"
                        :class="calView === 'week'  ? 'btn-neutral' : 'btn-ghost'">Semana</button>
                <button @click="switchView('day')"   class="btn btn-xs join-item"
                        :class="calView === 'day'   ? 'btn-neutral' : 'btn-ghost'">Dia</button>
            </div>

            <div class="flex items-center gap-1 min-w-0">
                <button @click="prev()" class="btn btn-ghost btn-sm btn-square shrink-0" aria-label="Anterior">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <span class="font-semibold text-sm capitalize text-center truncate min-w-0 flex-1" x-text="navLabel"></span>
                <button @click="next()" class="btn btn-ghost btn-sm btn-square shrink-0" aria-label="Próximo">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- ════════════════════════════════════════════════════════════ --}}
        {{--  MONTH VIEW                                                  --}}
        {{-- ════════════════════════════════════════════════════════════ --}}
        <div x-show="calView === 'month'">

            <div class="grid grid-cols-7 mb-1">
                <template x-for="wd in weekdays" :key="wd">
                    <span class="text-center text-xs text-base-content/40 font-medium py-1" x-text="wd"></span>
                </template>
            </div>

            <div class="grid grid-cols-7">
                <template x-for="cell in days" :key="cell.date">
                    <div class="flex flex-col items-stretch py-px min-h-[4rem]">

                        <div
                            class="relative flex justify-center"
                            @click="selectDay(cell.date)"
                            @mouseenter="mode === 'range' && !rangeEnd && cell.isCurrentMonth && (hovering = cell.date)"
                            @mouseleave="mode === 'range' && (hovering = null)"
                        >
                            <div
                                class="absolute inset-y-0 z-0 transition-all"
                                :class="{
                                    'bg-primary/15':    inRange(cell.date) || (isStart(cell.date) && rangeEnd) || isEnd(cell.date),
                                    'left-1/2 right-0': isStart(cell.date) && rangeEnd,
                                    'left-0 right-1/2': isEnd(cell.date) && rangeStart,
                                    'inset-x-0':        inRange(cell.date),
                                }"
                            ></div>
                            <button
                                class="relative z-10 w-7 h-7 flex items-center justify-center text-xs rounded-full transition-colors cursor-pointer"
                                :class="{
                                    'opacity-25 pointer-events-none': !cell.isCurrentMonth,
                                    'bg-primary text-primary-content font-bold shadow': isSelected(cell.date),
                                    'ring-1 ring-primary ring-inset': isToday(cell.date) && !isSelected(cell.date),
                                    'hover:bg-base-300': !isSelected(cell.date) && cell.isCurrentMonth,
                                    'bg-primary/20': inRange(cell.date) && !isSelected(cell.date),
                                }"
                                x-text="parseInt(cell.date.slice(8))"
                                :aria-label="cell.date"
                                :aria-pressed="isSelected(cell.date)"
                            ></button>
                        </div>

                        <div class="flex flex-col gap-px px-0.5 mt-0.5">
                            <template x-for="(ev, i) in eventsForDay(cell.date).slice(0, 2)" :key="ev.id + '-' + cell.date">
                                <div
                                    @click.stop="_fire('event-click', { id: ev.id, event: ev })"
                                    class="text-[10px] leading-tight px-1 py-px rounded truncate cursor-pointer w-full"
                                    :class="[pillColorClass(ev.color), ev.active !== false ? '' : 'opacity-40']"
                                    :title="ev.title"
                                    x-text="ev.title"
                                ></div>
                            </template>
                            <template x-if="eventsForDay(cell.date).length > 2">
                                <div class="text-[10px] text-base-content/40 px-1"
                                     x-text="`+${eventsForDay(cell.date).length - 2}`"></div>
                            </template>
                        </div>

                    </div>
                </template>
            </div>

        </div>

        {{-- ════════════════════════════════════════════════════════════ --}}
        {{--  WEEK VIEW                                                   --}}
        {{-- ════════════════════════════════════════════════════════════ --}}
        <div x-show="calView === 'week'">

            <div class="grid grid-cols-7 gap-px mb-1">
                <template x-for="day in weekDays" :key="day">
                    <div
                        class="text-center py-1 cursor-pointer rounded hover:bg-base-200 transition-colors"
                        @click="selectDay(day)"
                    >
                        <div class="text-xs text-base-content/40"
                             x-text="new Date(day + 'T00:00:00').toLocaleDateString(locale, { weekday: 'short' })"></div>
                        <div
                            class="text-sm font-semibold mx-auto w-7 h-7 flex items-center justify-center rounded-full"
                            :class="isToday(day) ? 'bg-primary text-primary-content' : ''"
                            x-text="parseInt(day.slice(8))"
                        ></div>
                    </div>
                </template>
            </div>

            <div
                class="grid grid-cols-7 gap-x-px mt-1"
                :style="`grid-template-rows: repeat(${weekRows}, 1.75rem)`"
                style="min-height: 1.75rem"
            >
                <template x-for="item in weekLayout" :key="item.ev.id">
                    <div
                        @click.stop="_fire('event-click', { id: item.ev.id, event: item.ev })"
                        :style="`grid-row: ${item.row + 1}; grid-column: ${item.colStart + 1} / ${item.colEnd + 2}`"
                        class="flex items-center gap-0.5 px-1.5 text-[11px] rounded cursor-pointer truncate h-6 my-px"
                        :class="[pillColorClass(item.ev.color), item.ev.active !== false ? '' : 'opacity-40',
                                 item.continuesLeft  ? 'rounded-l-none pl-0.5' : '',
                                 item.continuesRight ? 'rounded-r-none pr-0.5' : '']"
                        :title="item.ev.title"
                    >
                        <span x-show="item.continuesLeft"  class="shrink-0">←</span>
                        <span class="truncate font-medium" x-text="item.ev.title"></span>
                        <span x-show="item.continuesRight" class="shrink-0">→</span>
                    </div>
                </template>
            </div>

            <template x-if="weekLayout.length === 0">
                <p class="text-center text-sm text-base-content/30 italic py-6">Sem eventos nesta semana</p>
            </template>

        </div>

        {{-- ════════════════════════════════════════════════════════════ --}}
        {{--  DAY VIEW                                                    --}}
        {{-- ════════════════════════════════════════════════════════════ --}}
        <div x-show="calView === 'day'">

            {{-- All-day band --}}
            <template x-if="dayAllDayEvents.length > 0">
                <div class="border-b border-base-300 pb-2 mb-1">
                    <div class="text-[10px] uppercase tracking-wide text-base-content/30 pl-12 mb-1">Dia inteiro</div>
                    <div class="pl-12 space-y-0.5">
                        <template x-for="ev in dayAllDayEvents" :key="'allday-' + ev.id">
                            <div
                                @click="_fire('event-click', { id: ev.id, event: ev })"
                                class="flex items-center gap-2 px-2 py-1 rounded cursor-pointer text-xs"
                                :class="[pillColorClass(ev.color), ev.active !== false ? '' : 'opacity-40']"
                            >
                                <span class="font-medium truncate" x-text="ev.title"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </template>

            {{-- Timed slot grid --}}
            <div x-ref="dayScroll" class="overflow-y-auto max-h-[32rem]">
                <div class="flex" :style="`height: ${(dayEnd - dayStart) * slotHeight}px`">

                    {{-- Time labels --}}
                    <div class="w-12 shrink-0 relative">
                        <template x-for="h in hours" :key="'label-' + h">
                            <div
                                class="absolute right-2 text-xs text-base-content/30 tabular-nums"
                                :style="`top: ${(h - dayStart) * slotHeight - 8}px`"
                                x-text="`${String(h).padStart(2,'0')}h`"
                            ></div>
                        </template>
                    </div>

                    {{-- Slot zones + events --}}
                    <div class="flex-1 relative">

                        <template x-for="h in hours" :key="'slot-' + h">
                            <div
                                class="absolute left-0 right-0 border-t border-base-300"
                                :style="`top: ${(h - dayStart) * slotHeight}px`"
                            >
                                <div
                                    class="absolute inset-x-0 top-0 cursor-pointer hover:bg-base-200/50 transition-colors"
                                    :style="`height: ${slotHeight / 2}px`"
                                    @click="clickSlot(h, 0)"
                                ></div>
                                <div
                                    class="absolute inset-x-0 cursor-pointer hover:bg-base-200/50 transition-colors border-t border-dashed border-base-300/40"
                                    :style="`top: ${slotHeight / 2}px; height: ${slotHeight / 2}px`"
                                    @click="clickSlot(h, 30)"
                                ></div>
                            </div>
                        </template>

                        <template x-for="item in dayTimedLayout" :key="'timed-' + item.ev.id">
                            <div
                                @click.stop="_fire('event-click', { id: item.ev.id, event: item.ev })"
                                class="absolute z-10 rounded px-1.5 pt-0.5 pb-px text-xs overflow-hidden cursor-pointer shadow-sm"
                                :class="[pillColorClass(item.ev.color), item.ev.active !== false ? '' : 'opacity-50']"
                                :style="`
                                    top:    ${item.startMin / 60 * slotHeight}px;
                                    height: ${Math.max(22, (item.endMin - item.startMin) / 60 * slotHeight - 2)}px;
                                    left:   calc(${item.col / item.totalCols * 100}% + 2px);
                                    width:  calc(${100 / item.totalCols}% - 4px);
                                `"
                            >
                                <div class="font-medium leading-tight truncate" x-text="item.ev.title"></div>
                                <div
                                    class="opacity-60 leading-tight tabular-nums text-[10px]"
                                    x-show="item.ev.start?.length > 10"
                                    x-text="item.ev.start?.slice(11, 16)"
                                ></div>
                            </div>
                        </template>

                        <template x-if="isToday(cursorDate)">
                            <div
                                class="absolute left-0 right-0 z-20 pointer-events-none"
                                :style="`top: ${currentTimeTop}px`"
                            >
                                <div class="absolute -left-1 -top-1.5 w-2.5 h-2.5 rounded-full bg-error"></div>
                                <div class="border-t-2 border-error"></div>
                            </div>
                        </template>

                    </div>
                </div>
            </div>

            <template x-if="dayEvents.length === 0">
                <p class="text-center text-sm text-base-content/30 italic py-4">Sem eventos neste dia</p>
            </template>

        </div>

        {{-- ── Legend (range mode only) ─────────────────────────────── --}}
        @if(($cfg['mode'] ?? 'single') === 'range')
        <div class="flex items-center gap-4 mt-3 pt-3 border-t border-base-300 text-xs text-base-content/40">
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-success"></span>success</span>
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-warning"></span>warning</span>
            <span class="flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-error"></span>error</span>
        </div>
        @endif

    </div>
</div>

