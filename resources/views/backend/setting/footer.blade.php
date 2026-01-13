@extends('backend.layouts.app')

@section('content')

<style>
    .upload-preview-box {
        position: relative;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background: #f8f9fa;
        transition: all 0.3s ease;
        min-height: 150px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .upload-preview-box:hover {
        border-color: #0d6efd;
        background: #e7f1ff;
    }

    .upload-preview-box.has-image {
        border-color: #198754;
        background: #fff;
    }

    .preview-image {
        max-width: 100%;
        max-height: 100px;
        border-radius: 6px;
        margin-bottom: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        object-fit: contain;
    }

    .upload-text {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .file-input-wrapper {
        position: relative;
        width: 100%;
    }

    .file-input-wrapper input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        cursor: pointer;
        z-index: 5;
    }

    .btn-choose-file {
        background: #0d6efd;
        color: white;
        padding: 8px 20px;
        border-radius: 6px;
        font-size: 14px;
        display: inline-block;
        cursor: pointer;
        transition: all 0.3s ease;
        pointer-events: none;
    }

    .btn-choose-file:hover {
        background: #0b5ed7;
    }

    .btn-remove-image {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
    }

    .btn-remove-image:hover {
        background: #bb2d3b;
        transform: scale(1.1);
    }

    .section-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }

    .section-header {
        display: flex;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid #0d6efd;
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }

    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-control, .form-control:focus {
        border-radius: 6px;
        border: 1px solid #dee2e6;
        padding: 10px 15px;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
    }

    .save-button {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
        border: none;
        padding: 12px 40px;
        font-size: 16px;
        font-weight: 600;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        transition: all 0.3s ease;
    }

    .save-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
    }

    .input-group-custom {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .input-group-custom .form-control {
        flex: 1;
    }

    .social-preview {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
    }
</style>

<div class="container-fluid">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-footer me-2"></i>Footer Settings
            </h4>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('settings.footer.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ================= Branding Section ================= --}}
                <div class="section-card">
                    <div class="section-header">
                        <h5 class="section-title">Branding & Newsletter</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Logo Text - "TRADES" Part</label>
                            <input type="text" class="form-control" name="logo_text_trades"
                                   value="{{ $branding->value['logo_text_trades'] ?? 'TRADES' }}"
                                   placeholder="Enter TRADES text">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Logo Text - "AXIS" Part</label>
                            <input type="text" class="form-control" name="logo_text_axis"
                                   value="{{ $branding->value['logo_text_axis'] ?? 'AXIS' }}"
                                   placeholder="Enter AXIS text">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Logo Image (Optional - SVG/PNG)</label>
                            <div class="upload-preview-box {{ isset($branding->value['logo_image']) && $branding->value['logo_image'] ? 'has-image' : '' }}" id="logo-preview-box">
                                @if(isset($branding->value['logo_image']) && $branding->value['logo_image'])
                                    <button type="button" class="btn-remove-image" onclick="removeImage('logo')">✕</button>
                                    <img src="{{ asset($branding->value['logo_image']) }}" class="preview-image" id="logo-preview">
                                @endif
                                <div class="upload-text">{{ isset($branding->value['logo_image']) && $branding->value['logo_image'] ? 'Click to change logo' : 'Click to upload logo image' }}</div>
                                <div class="file-input-wrapper">
                                    <span class="btn-choose-file">Choose Logo</span>
                                    <input type="file" name="logo_image" accept="image/*" onchange="previewImage(event, 'logo')">
                                </div>
                            </div>
                            <input type="hidden" name="logo_image_old" value="{{ $branding->value['logo_image'] ?? '' }}">
                            <small class="text-muted">Leave empty to use text-only logo</small>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Tagline</label>
                            <input type="text" class="form-control" name="tagline"
                                   value="{{ $branding->value['tagline'] ?? 'Complete system for your eCommerce business' }}"
                                   placeholder="Enter tagline">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Newsletter Text</label>
                            <textarea class="form-control" name="newsletter_text" rows="2"
                                      placeholder="Enter newsletter description">{{ $branding->value['newsletter_text'] ?? 'Subscribe to our newsletter for regular updates about Offers, Coupons & more' }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- ================= Social Media Links ================= --}}
                <div class="section-card">
                    <div class="section-header">
                        <h5 class="section-title">Social Media Links</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-facebook text-primary me-2"></i>Facebook URL
                            </label>
                            <input type="url" class="form-control" name="facebook"
                                   value="{{ $social->value['facebook'] ?? '#' }}"
                                   placeholder="https://facebook.com/yourpage">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-twitter text-info me-2"></i>Twitter URL
                            </label>
                            <input type="url" class="form-control" name="twitter"
                                   value="{{ $social->value['twitter'] ?? '#' }}"
                                   placeholder="https://twitter.com/yourpage">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-instagram text-danger me-2"></i>Instagram URL
                            </label>
                            <input type="url" class="form-control" name="instagram"
                                   value="{{ $social->value['instagram'] ?? '#' }}"
                                   placeholder="https://instagram.com/yourpage">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-youtube text-danger me-2"></i>YouTube URL
                            </label>
                            <input type="url" class="form-control" name="youtube"
                                   value="{{ $social->value['youtube'] ?? '#' }}"
                                   placeholder="https://youtube.com/yourchannel">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-linkedin text-primary me-2"></i>LinkedIn URL
                            </label>
                            <input type="url" class="form-control" name="linkedin"
                                   value="{{ $social->value['linkedin'] ?? '#' }}"
                                   placeholder="https://linkedin.com/company/yourcompany">
                        </div>
                    </div>
                </div>

                {{-- ================= Contact Information ================= --}}
                <div class="section-card">
                    <div class="section-header">
                        <h5 class="section-title">Contact Information</h5>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                <i class="bi bi-geo-alt-fill text-danger me-2"></i>Address
                            </label>
                            <textarea class="form-control" name="address" rows="2"
                                      placeholder="Enter company address">{{ $contact->value['address'] ?? 'Demo Address' }}</textarea>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-telephone-fill text-success me-2"></i>Phone
                            </label>
                            <input type="text" class="form-control" name="phone"
                                   value="{{ $contact->value['phone'] ?? '123456789' }}"
                                   placeholder="Enter phone number">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="bi bi-envelope-fill text-primary me-2"></i>Email
                            </label>
                            <input type="email" class="form-control" name="email"
                                   value="{{ $contact->value['email'] ?? 'demo.example@gmail.com' }}"
                                   placeholder="Enter email address">
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary save-button">
                        <i class="bi bi-save me-2"></i>Save All Changes
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event, id) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        const previewBox = document.getElementById(id + '-preview-box');
        previewBox.classList.add('has-image');

        let img = previewBox.querySelector('.preview-image');
        if (img) {
            img.src = e.target.result;
        } else {
            img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'preview-image';
            img.id = id + '-preview';
            previewBox.insertBefore(img, previewBox.querySelector('.upload-text'));
        }

        if (!previewBox.querySelector('.btn-remove-image')) {
            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'btn-remove-image';
            removeBtn.innerHTML = '✕';
            removeBtn.onclick = function(e) {
                e.stopPropagation();
                removeImage(id);
            };
            previewBox.insertBefore(removeBtn, previewBox.firstChild);
        }

        const uploadText = previewBox.querySelector('.upload-text');
        if (uploadText) {
            uploadText.textContent = 'Click to change logo';
        }
    }
    reader.readAsDataURL(file);
}

function removeImage(id) {
    const previewBox = document.getElementById(id + '-preview-box');
    const fileInput = previewBox.querySelector('input[type="file"]');

    fileInput.value = '';

    const img = previewBox.querySelector('.preview-image');
    const removeBtn = previewBox.querySelector('.btn-remove-image');
    if (img) img.remove();
    if (removeBtn) removeBtn.remove();

    const uploadText = previewBox.querySelector('.upload-text');
    if (uploadText) {
        uploadText.textContent = 'Click to upload logo image';
    }

    previewBox.classList.remove('has-image');

    const oldInput = document.querySelector(`input[name="${id}_image_old"]`);
    if (oldInput) oldInput.value = '';
}
</script>

@endsection
