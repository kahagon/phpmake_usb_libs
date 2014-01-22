<?php
namespace PHPMake\USB\Device;
use PHPMake\USB;
use PHPMake\USB\Device;

class Video implements Device {

    public function getClassCode() {
        return self::CC_VIDEO;
    }

    public static function nameForSubclass($subclass) {
        return USB::constantNameForValueWithRegex($subclass, __CLASS__, '/^SC_/');
    }

    public static function nameForProtocol($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^PC_/');
    }

    public static function nameForDescriptorType($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^CS_/');
    }

    public static function nameForVCInterfaceDescriptorSubtype($value) {
        $names = USB::constantNamesForValue(
            $value, __CLASS__, function ($name) {
                return preg_match('/^VC_/', $name) && !in_array($name, array(
                    'VC_CONTROL_UNDEFINED',
                    'VC_VIDEO_POWER_MODE_CONTROL',
                    'VC_REQUEST_ERROR_CODE_CONTROL'));
            });

        if (count($names)>0) {
            return $names[0];
        } else {
            return "**UNKNOWN**";
        }
    }

    public static function nameForVSInterfaceDescriptorSubtype($value) {
        $names = USB::constantNamesForValue(
            $value, __CLASS__, function ($name) {
                return preg_match('/^VS_/', $name) 
                        && !in_array($name, Video::$VSInterfaceControlSelectors);
            });

        if (count($names)>0) {
            return $names[0];
        } else {
            return "**UNKNOWN**";
        }

    }

    public static function nameForEndpointDescriptorSubtype($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^EP_/');
    }

    public static function nameForRequestCode($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^(?:RC_UNDEFINED|SET_|GET_)/');
    }

    public static function nameForVCInterfaceControlSelector($value) {
        $names = USB::constantNamesForValue(
            $value, __CLASS__, function ($name) {
                return in_array($name, array(
                    'VC_CONTROL_UNDEFINED',
                    'VC_VIDEO_POWER_MODE_CONTROL',
                    'VC_REQUEST_ERROR_CODE_CONTROL'));
            });

        if (count($names)>0) {
            return $names[0];
        } else {
            return "**UNKNOWN**";
        }
    }

    public static function nameForTerminalControlSelector($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^TE_/');
    }

    public static function nameForSelectorUnitControlSelector($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^SU_/');
    }

    public static function nameForCameraTerminalControlSelector($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^CT_/');
    }

    public static function nameForProcessingUnitControlSelector($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^PU_/');
    }

    public static function nameForEncodingUnitControlSelector($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^EU_/');
    }

    public static function nameForExtensionUnitControlSelector($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^XU_/');
    }

    public static function nameForVSInterfaceControlSelector($value) {
        $names = USB::constantNamesForValue(
            $value, __CLASS__, function ($name) {
                return in_array($name, Video::$VSInterfaceControlSelectors);
            });

        if (count($names)>0) {
            return $names[0];
        } else {
            return "**UNKNOWN**";
        }
    }

    public static function nameForTerminalType($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^TT_/');
    }

    public static function nameForInputTerminalType($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^ITT_/');
    }

    public static function nameForOutputTerminalType($value) {
        return USB::constantNameForValueWithRegex($value, __CLASS__, '/^OTT_/');
    }

    public static function nameForExternalTerminalType($value) {
        $names = USB::constantNamesForValue(
            $value, __CLASS__, function ($name) {
                return in_array($name, Video::$externalTerminalTypes);
            });

        if (count($names)>0) {
            return $names[0];
        } else {
            return "**UNKNOWN**";
        }
    }

   
    public static $VSInterfaceControlSelectors = array(
        'VS_CONTROL_UNDEFINED',
        'VS_PROBE_CONTROL',
        'VS_COMMIT_CONTROL',
        'VS_STILL_PROBE_CONTROL',
        'VS_STILL_COMMIT_CONTROL',
        'VS_STILL_IMAGE_TRIGGER_CONTROL',
        'VS_STREAM_ERROR_CODE_CONTROL',
        'VS_GENERATE_KEY_FRAME_CONTROL',
        'VS_UPDATE_FRAME_SEGMENT_CONTROL',
        'VS_SYNCH_DELAY_CONTROL');

    /* Video Interface Class Code */
    const CC_VIDEO = 0x0E;

    /* Video Interface Subclass Codes */
    const SC_UNDEFINED = 0x00;
    const SC_VIDEOCONTROL = 0x01;
    const SC_VIDEOSTREAMING = 0x02;
    const SC_VIDEO_INTERFACE_COLLECTION = 0x03;

    /* Video Interface Protocol Codes */
    const PC_PROTOCOL_UNDEFINED = 0x01;
    const PC_PROTOCOL_15 = 0x01;

    /* Video Class-Specific Descriptor Types */
    const CS_UNDEFINED = 0x20;
    const CS_DEVICE = 0x21;
    const CS_CONFIGURATION = 0x22;
    const CS_STRING = 0x23;
    const CS_INTERFACE = 0x24;
    const CS_ENDPOINT = 0x25;

    /* Video Class-Specific VC(Video Control) Interface Descriptor Subtypes */
    const VC_DESCRIPTOR_UNDEFINED = 0x00;
    const VC_HEADER = 0x01;
    const VC_INPUT_TERMINAL = 0x02;
    const VC_OUTPUT_TERMINAL = 0x03;
    const VC_SELECTOR_UNIT = 0x04;
    const VC_PROCESSING_UNIT = 0x05;
    const VC_EXTENSION_UNIT = 0x06;
    const VC_ENCODING_UNIT = 0x07;

    /* Video Class-Specific VS(Video Streaming) Interface Descriptor Subtypes */
    const VS_UNDEFINED = 0x00;
    const VS_INPUT_HEADER = 0x01;
    const VS_OUTPUT_HEADER = 0x02;
    const VS_STILL_IMAGE_FRAME = 0x03;
    const VS_FORMAT_UNCOMPRESSED = 0x04;
    const VS_FRAME_UNCOMPRESSED = 0x05;
    const VS_FORMAT_MJPEG = 0x06;
    const VS_FRAME_MJPEG = 0x07;
    const VS_FORMAT_MPEG2TS = 0x0A;
    const VS_FORMAT_DV = 0x0C;
    const VS_CONTROLFORMAT = 0x0D;
    const VS_FORMAT_FRAME_BASED = 0x10;
    const VS_FRAME_FRAME_BASED = 0x11;
    const VS_FORMAT_STREAM_BASED = 0x12;
    const VS_FORMAT_H264 = 0x13;
    const VS_FRAME_H264 = 0x14;
    const VS_FORMAT_H264_SIMULCAST = 0x15;
    const VS_FORMAT_VP8 = 0x16;
    const VS_FRAME_VP8 = 0x17;
    const VS_FORMAT_VP8_SIMULCAST = 0x18;

    /* Vide Class-Specific Endpoint Descriptor Subtypes */
    const EP_UNDEFINED = 0x00;
    const EP_GENERAL = 0x01;
    const EP_ENDPOINT = 0x02;
    const EP_INTERRUPT = 0x03;

    /* Video Class-Specific Request Codes */
    const RC_UNDEFINED = 0x00;
    const SET_CUR = 0x01;
    const SET_CUR_ALL = 0x11;
    const GET_CUR = 0x81;
    const GET_MIN = 0x82;
    const GET_MAX = 0x83;
    const GET_RES = 0x84;
    const GET_LEN = 0x85;
    const GET_INFO = 0x86;
    const GET_DEF = 0x87;
    const GET_CUR_ALL = 0x91;
    const GET_MIN_ALL = 0x92;
    const GET_MAX_ALL = 0x93;
    const GET_RES_ALL = 0x94;
    const GET_DEF_ALL = 0x97;

    /* VideoControl Interface Control Selectors */
    const VC_CONTROL_UNDEFINED = 0x00;
    const VC_VIDEO_POWER_MODE_CONTROL = 0x01;
    const VC_REQUEST_ERROR_CODE_CONTROL = 0x02;

    /* Terminal Control Selectors */
    const TE_CONTROL_UNDEFINED = 0x00;

    /* Selector Unit Control Selectors */
    const SU_CONTROL_UNDEFINED = 0x00;
    const SU_INPUT_SELECT_CONTROL = 0x01;

    /* Camera Terminal Control Selectors */
    const CT_CONTROL_UNDEFINED = 0x00;
    const CT_SCANNING_MODE_CONTROL = 0x01;
    const CT_AE_MODE_CONTROL = 0x02;
    const CT_AE_PRIORITY_CONTROL = 0x03;
    const CT_EXPOSURE_TIME_ABSOLUTE_CONTROL = 0x04;
    const CT_EXPOSURE_TIME_RELATIVE_CONTROL = 0x05;
    const CT_FOCUS_ABSOLUTE_CONTROL = 0x06;
    const CT_FOCUS_RELATIVE_CONTROL = 0x07;
    const CT_FOCUS_AUTO_CONTROL = 0x08;
    const CT_IRIS_ABSOLUTE_CONTROL = 0x09;
    const CT_IRIS_RELATIVE_CONTROL = 0x0A;
    const CT_ZOOM_ABSOLUTE_CONTROL = 0x0B;
    const CT_ZOOM_RELATIVE_CONTROL = 0x0C;
    const CT_PANTILT_ABSOLUTE_CONTROL = 0x0D;
    const CT_PANTILT_RELATIVE_CONTROL = 0x0E;
    const CT_ROLL_ABSOLUTE_CONTROL = 0x0F;
    const CT_ROLL_RELATIVE_CONTROL = 0x10;
    const CT_PRIVACY_CONTROL = 0x11;
    const CT_FOCUS_SIMPLE_CONTROL = 0x12;
    const CT_WINDOW_CONTROL = 0x13;
    const CT_REGION_OF_INTEREST_CONTROL = 0x14;

    /* Processing Unit Control Selectors */
    const PU_CONTROL_UNDEFINED = 0x00;
    const PU_BACKLIGHT_COMPENSATION_CONTROL = 0x01;
    const PU_BRIGHTNESS_CONTROL = 0x02;
    const PU_CONTRAST_CONTROL = 0x03;
    const PU_GAIN_CONTROL = 0x04;
    const PU_POWER_LINE_FREQUENCY_CONTROL = 0x05;
    const PU_HUE_CONTROL = 0x06;
    const PU_SATURATION_CONTROL = 0x07;
    const PU_SHARPNESS_CONTROL = 0x08;
    const PU_GAMMA_CONTROL = 0x09;
    const PU_WHITE_BALANCE_TEMPERATURE_CONTROL = 0x0A;
    const PU_WHITE_BALANCE_TEMPERATURE_AUTO_CONTROL = 0x0B;
    const PU_WHITE_BALANCE_COMPONENT_CONTROL = 0x0C;
    const PU_WHITE_BALANCE_COMPONENT_AUTO_CONTROL = 0x0D;
    const PU_DIGITAL_MULTIPLIER_CONTROL = 0x0E;
    const PU_DIGITAL_MULTIPLIER_LIMIT_CONTROL = 0x0F;
    const PU_HUE_AUTO_CONTROL = 0x10;
    const PU_ANALOG_VIDEO_STANDARD_CONTROL = 0x11;
    const PU_ANALOG_LOCK_STATUS_CONTROL = 0x12;
    const PU_CONTRAST_AUTO_CONTROL = 0x13;

    /* Encoding Unit Control Selectors */
    const EU_CONTROL_UNDEFINED = 0x00;
    const EU_SELECT_LAYER_CONTROL = 0x01;
    const EU_PROFILE_TOOLSET_CONTROL = 0x02;
    const EU_VIDEO_RESOLUTION_CONTROL = 0x03;
    const EU_MIN_FRAME_INTERVAL_CONTROL = 0x04;
    const EU_SLICE_MODE_CONTROL = 0x05;
    const EU_RATE_CONTROL_MODE_CONTROL = 0x06;
    const EU_AVERAGE_BITRATE_CONTROL = 0x07;
    const EU_CPB_SIZE_CONTROL = 0x08;
    const EU_PEAK_BIT_RATE_CONTROL = 0x09;
    const EU_QUANTIZATION_PARAMS_CONTROL = 0x0A;
    const EU_SYNC_REF_FRAME_CONTROL = 0x0B;
    const EU_LTR_BUFFER_CONTROL = 0x0C;
    const EU_LTR_PICTURE_CONTROL = 0x0D;
    const EU_LTR_VALIDATION_CONTROL = 0x0E;
    const EU_LEVEL_IDC_LIMIT_CONTROL = 0x0F;
    const EU_SEI_PAYLOADTYPE_CONTROL = 0x10;
    const EU_QP_RANGE_CONTROL = 0x11;
    const EU_PRIORITY_CONTROL = 0x12;
    const EU_START_OR_STOP_LAYER_CONTROL = 0x13;
    const EU_ERROR_RESILIENCY_CONTROL = 0x14;
    
    /* Extension Unit Control Selectors */
    const XU_CONTROL_UNDEFINED = 0x00;

    /* VideoStreaming Interface Control Selectors */
    const VS_CONTROL_UNDEFINED = 0x00;
    const VS_PROBE_CONTROL = 0x01;
    const VS_COMMIT_CONTROL = 0x02;
    const VS_STILL_PROBE_CONTROL = 0x03;
    const VS_STILL_COMMIT_CONTROL = 0x04;
    const VS_STILL_IMAGE_TRIGGER_CONTROL = 0x05;
    const VS_STREAM_ERROR_CODE_CONTROL = 0x06;
    const VS_GENERATE_KEY_FRAME_CONTROL = 0x07;
    const VS_UPDATE_FRAME_SEGMENT_CONTROL = 0x08;
    const VS_SYNCH_DELAY_CONTROL = 0x09;

    /* USB Terminal Types 
     * These Terminal types describe Terminals that handle signals carried over the USB,
     * through isochronous or bulk pipes.
     * These Terminal types are valid for both Input and Output Terminals. */
    /**
     * A Terminal dealing with a signal carried over a vendor-specific interface.
     * The vendor-specific interface descriptor 
     * must contain a field that references the Terminal.
     *
     * I/O: both
     */
    const TT_VENDOR_SPECIFIC = 0x0100;
    /**
     * A Terminal dealing with a signal carried over an endpoint 
     * in a VideoStreaming interface.
     * The VideoStreaming interface descriptor points to 
     * the associated Terminal through the bTerminalLink field.
     *
     * I/O: both
     */
    const TT_STREAMING = 0x0101;

    /* Input Terminal Types 
     * These Terminal Types describe Terminals that are designed to capture video.
     * They either are physically part of the video function or 
     * can be assumed to be connected to it in normal operation.
     * These Terminal Types are valid only for Input Terminals. */
    /**
     * Vendor-Specific Input Terminal.
     * 
     * I/O: Input
     */
    const ITT_VENDOR_SPECIFIC = 0x0200;
    /**
     * Camera sensor. 
     * To be used only in Camera Terminal descriptors.
     * 
     * I/O: Input
     */
    const ITT_CAMERA = 0x0201;
    /**
     * Sequential media.
     * To be used only in Media Transport Terminal Descriptors.
     * 
     * I/O: Input
     */
    const ITT_MEDIA_TRANSPORT_INPUT = 0x0202;

    /* Output Terminal Types
     * These Terminal types describe Terminals that are designed to render video.
     * They are either physically part of the video function or 
     * can be assumed to be connected to it in normal operation.
     * These Terminal types are only valid for Output Terminals. */
    /**
     * Vendor-Specific Output Terminal.
     *
     * I/O: Output
     */
    const OTT_VENDOR_SPECIFIC = 0x0300;
    /**
     * Generic display (LCD, CRT, etc.).
     *
     * I/O: Output
     */
    const OTT_DISPLAY = 0x0301;
    /**
     * Sequential media .
     * To be used only in Media Transport Terminal Descriptors.
     *
     * I/O: Output
     */
    const OTT_MEDIA_TRANSPORT_OUTPUT = 0x0302;

    /* External Terminal Types 
     * These Terminal types describe external resources and connections that 
     * do not fit under the categories of Input or Output Terminals 
     * because they do not necessarily translate video signals to
     * or from the user of the computer.
     * Most of them may be either Input or Output Terminals.*/
    /**
     * Vendor-Specific External Terminal.
     *
     * I/O: both
     */
    const EXTERNAL_VENDOR_SPECIFIC = 0x0400;
    /**
     * Composite video connector.
     *
     * I/O: both
     */
    const COMPOSITE_CONNECTOR = 0x0401;
    /**
     * S-video connector.
     * 
     * I/O: both
     */
    const SVIDEO_CONNECTOR = 0x0402;
    /**
     * Component video connector. 
     *
     * I/O: both 
     */
    const COMPONENT_CONNECTOR = 0x0403;

    public static $externalTerminalTypes = array(
        'EXTERNAL_VENDOR_SPECIFIC',
        'COMPOSITE_CONNECTOR',
        'SVIDEO_CONNECTOR',
        'COMPONENT_CONNECTOR'
    );
}


















