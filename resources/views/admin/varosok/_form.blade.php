@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Hoppá! Valami hiba történt.</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@csrf <div class="field">
    <label for="nev">Város Neve</label>
    <input type="text" name="nev" id="nev" value="{{ old('nev', $varos->nev ?? '') }}" required>
</div>

<div class="field">
    <label for="megyeid">Megye</label>
    <select name="megyeid" id="megyeid" required>
        <option value="">Válassz megyét...</option>
        @foreach ($megyek as $megye)
            <option value="{{ $megye->id }}" 
                {{-- Kiválasztja az alapértelmezettet, ha van --}}
                {{ old('megyeid', $varos->megyeid ?? '') == $megye->id ? 'selected' : '' }}>
                {{ $megye->nev }}
            </option>
        @endforeach
    </select>
</div>

<div class="field">
    <label>Megyeszékhely?</label>
    <label for="mszh_igen">
        <input type="radio" id="mszh_igen" name="megyeszekhely" value="1" 
               {{ old('megyeszekhely', $varos->megyeszekhely ?? '0') == '1' ? 'checked' : '' }}>
        Igen
    </label>
    <label for="mszh_nem" style="margin-left: 1rem;">
        <input type="radio" id="mszh_nem" name="megyeszekhely" value="0"
               {{ old('megyeszekhely', $varos->megyeszekhely ?? '0') == '0' ? 'checked' : '' }}>
        Nem
    </label>
</div>

<div class="field">
    <label>Megyei jogú?</label>
    <label for="mj_igen">
        <input type="radio" id="mj_igen" name="megyeijogu" value="1"
               {{ old('megyeijogu', $varos->megyeijogu ?? '0') == '1' ? 'checked' : '' }}>
        Igen
    </label>
    <label for="mj_nem" style="margin-left: 1rem;">
        <input type="radio" id="mj_nem" name="megyeijogu" value="0"
               {{ old('megyeijogu', $varos->megyeijogu ?? '0') == '0' ? 'checked' : '' }}>
        Nem
    </label>
</div>

<div style="margin-top: 1.5rem;">
    <button type="submit" class="button">Mentés</button>
    <a href="{{ route('admin.varosok.index') }}" class="button button-secondary" style="background-color: #6c757d; margin-left: 10px;">Mégse</a>
</div>